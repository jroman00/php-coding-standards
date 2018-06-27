<?php

namespace Jroman00\Sniffs\Namespaces;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ImportStatementsSniff implements Sniff
{
    /**
     * @var array
     */
    private $positionData = [];

    /**
     * @return array
     */
    public function register()
    {
        return [T_USE];
    }

    /**
     * @param File $phpcsFile
     * @param int $stackPtr
     * @return int
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $actual = [];
        $firstErrorLocation = null;
        foreach ($phpcsFile->getTokens() as $currentPosition => $token) {
            /**
             * If not a "use" token or the "use" token is from an anonymous function.
             *
             * For example:
             *     $foo = function () use ($bar) {
             *         // ...
             *     };
             */
            if ($token['type'] !== 'T_USE'
                || $token['level']
            ) {
                continue;
            }

            $semicolonPosition = $phpcsFile->findEndOfStatement($currentPosition);
            $importString = $phpcsFile->getTokensAsString(
                $currentPosition + 2,
                $semicolonPosition - $currentPosition - 2
            );

            if ($firstErrorLocation === null) {
                $firstErrorLocation = $currentPosition;
            }

            // Keep track of the "use" statement start/end positions in case we're fixing later.
            $this->positionData[] = [
                'start' => $currentPosition,
                'end' => $semicolonPosition,
            ];

            $actual[] = $importString;
        }

        if (count($actual) === 0) {
            return $phpcsFile->numTokens + 1;
        }

        // Start with $expected and $actual being the same before altering $expected and comparing the two.
        $expected = $actual;

        // Remove leading backslashes.
        array_walk($expected, function (&$importString) {
            $importString = ltrim($importString, '\\');
        });

        // Alphabetize (case insensitive).
        natcasesort($expected);

        // Remove duplicates.
        $expected = array_unique($expected);

        if ($actual !== $expected) {
            $error = 'Import statements must be unique, in alphabetical order, and contain no leading slashes.';
            $fix = $phpcsFile->addFixableError($error, $firstErrorLocation, 'Found');
            if ($fix === true) {
                $this->fixFile($phpcsFile, $expected);
            }
        }

        return $phpcsFile->numTokens + 1;
    }

    /**
     * @param File $phpcsFile
     * @param array $expected
     * @return void
     */
    private function fixFile(File $phpcsFile, array $expected)
    {
        // Prepare new import statements.
        $importStrings = array_map(function (&$importString) {
            return 'use ' . $importString . ';';
        }, $expected);

        $phpcsFile->fixer->beginChangeset();

        foreach ($this->positionData as $positionData) {
            for ($currentPosition = $positionData['start'];
                 $currentPosition <= $positionData['end'] + 1;
                 $currentPosition++) {
                $phpcsFile->fixer->replaceToken($currentPosition, '');
            }
        }

        // Find the start/end positions of the namespace token to place import statements immediately after it.
        $namespacePosition = $phpcsFile->findNext(T_NAMESPACE, 0);

        if ($namespacePosition !== false) {
            $endPosition = $phpcsFile->findEndOfStatement($namespacePosition);
            $phpcsFile->fixer->addContent($endPosition + 1, implode(PHP_EOL, $importStrings) . PHP_EOL);
        } else {
            $phpcsFile->fixer->addContent(0, implode(PHP_EOL, $importStrings) . PHP_EOL);
        }

        $phpcsFile->fixer->endChangeset();
    }
}

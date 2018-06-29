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
    public function process(File $phpcsFile, $stackPtr): int
    {
        $actual = [];
        $firstErrorLocation = null;

        $tokens = $phpcsFile->getTokens();

        $skipToPosition = null;
        foreach ($tokens as $currentPosition => $token) {
            /**
             * If what we see is a closure, we essentially want to jump to the
             * scope_closer position so that we don't accidentally process the
             * closure's own use statement
             *
             * For example:
             *     $foo = function () use ($bar) {
             *         // ...
             *     };
             */
            if ($skipToPosition !== null && $currentPosition < $skipToPosition) {
                continue;
            }

            $skipToPosition = null;
            if ($token['type'] === 'T_CLOSURE') {
                $skipToPosition = $tokens[$currentPosition]['scope_closer'];
                continue;
            }

            // We only want to process use statements from here on out
            if ($token['type'] !== 'T_USE') {
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
            for ($position = $positionData['start']; $position <= $positionData['end'] + 1; $position++) {
                $phpcsFile->fixer->replaceToken($position, '');
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

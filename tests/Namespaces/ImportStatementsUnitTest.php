<?php

namespace Jroman00\Sniffs\Namespaces;

use Exception;
use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class ImportStatementsUnitTest extends AbstractSniffUnitTest
{
    /**
     * Sets up this unit test.
     *
     * @return void
     */
    protected function setUp()
    {
        /**
         * I'm not exactly sure why this is the case, but this line has been
         * added because an otherwise passing test would print:
         *     There was 1 risky test:
         *
         *     1) Jroman00\Sniffs\Namespaces\ImportStatementsUnitTest::testSniff
         *     This test did not perform any assertions
         *
         *     OK, but incomplete, skipped, or risky tests!
         */
        $this->assertTrue(true);

        parent::setUp();
    }

    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int>
     * @throws Exception
     */
    public function getErrorList(string $testFile = ''): array
    {
        switch ($testFile) {
            case 'ImportStatementsUnitTest.1.inc':
            case 'ImportStatementsUnitTest.2.inc':
                return [];

            case 'ImportStatementsUnitTest.3.inc':
                return [
                    15 => 1,
                ];

            case 'ImportStatementsUnitTest.4.inc':
                return [
                    1 => 1,
                ];

            case 'ImportStatementsUnitTest.5.inc':
                return [
                    4 => 1,
                ];

            case 'ImportStatementsUnitTest.6.inc':
                return [
                    6 => 1,
                ];

            case 'ImportStatementsUnitTest.7.inc':
                return [
                    2 => 1,
                ];

            default:
                throw new Exception('Missing case statement for $testFile: ' . $testFile);
        }
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getWarningList(): array
    {
        return [];
    }
}

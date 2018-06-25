<?php

namespace Jroman00\Sniffs\Namespaces;

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
     * @return array<int, int>
     */
    public function getErrorList()
    {
        return [
            6 => 1,
        ];
    }

    /**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];
    }
}

<?php

use Jroman00\Sniffs\Namespaces\ImportStatementsUnitTest;

require __DIR__ . '/../vendor/autoload.php';

$GLOBALS['PHP_CODESNIFFER_STANDARD_DIRS'] = [
    ImportStatementsUnitTest::class => realpath(__DIR__ . '/../Jroman00/'),
];

$GLOBALS['PHP_CODESNIFFER_TEST_DIRS'] = [
    ImportStatementsUnitTest::class => __DIR__ . '/',
];

$GLOBALS['PHP_CODESNIFFER_SNIFF_CODES'] = [];
$GLOBALS['PHP_CODESNIFFER_FIXABLE_CODES'] = [];

require __DIR__ . '/../vendor/squizlabs/php_codesniffer/tests/bootstrap.php';

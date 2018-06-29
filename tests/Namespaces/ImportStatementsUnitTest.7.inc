<?php
use Foo\Bravo;
use \Foo\Bravo;
use Foo\Alpha;
use \Foo\Alpha;

$bar = function () use ($foo) {
    return $foo . ' world';
};

$bar('hello');

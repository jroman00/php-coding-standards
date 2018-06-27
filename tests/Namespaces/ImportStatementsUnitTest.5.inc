<?php

namespace App;
use Foo\Bravo;
use \Foo\Alpha;
use Exception;
use \Foo\Bravo;
use Foo\Alpha;
use \Exception;
class ExampleClass
{
    public function foo()
    {
        $foo = 'hello';

        $bar = function () use ($foo) {
            return $foo . ' world';
        };

        return $bar();
    }
}

<?php

namespace App\Foo;


use Foo\Charlie;use Foo\Bravo;
use \Foo\Bravo;
use Foo\Delta as FooDelta;

use Exception;


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
use \Foo\Alpha;

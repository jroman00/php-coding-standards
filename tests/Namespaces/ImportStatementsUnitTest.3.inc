<?php
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
use Foo\Bravo;
use \Foo\Bravo;
use Foo\Alpha;

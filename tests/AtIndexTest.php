<?php

use Enzyme\Name\Lang\En as Name;

class AtIndexTest extends PHPUnit_Framework_TestCase
{
    public function testAtIndexValid()
    {
        $name = Name::fromArgs('Foo', 'Bar');
        $expected = 'Foo';
        $this->assertEquals($expected, $name->atIndex(0));
        $expected = 'Bar';
        $this->assertEquals($expected, $name->atIndex(1));

        $name = Name::fromArray(['Foo', 'Bar']);
        $expected = 'Foo';
        $this->assertEquals($expected, $name->atIndex(0));
        $expected = 'Bar';
        $this->assertEquals($expected, $name->atIndex(1));

        $name = Name::fromString('Foo Bar');
        $expected = 'Foo';
        $this->assertEquals($expected, $name->atIndex(0));
        $expected = 'Bar';
        $this->assertEquals($expected, $name->atIndex(1));
    }

    public function testAtIndexInvalid()
    {
        $name = Name::fromArgs('Foo', 'Bar');
        $expected = null;
        $this->assertEquals($expected, $name->atIndex(3));

        $name = Name::fromArray(['Foo', 'Bar']);
        $expected = null;
        $this->assertEquals($expected, $name->atIndex(3));

        $name = Name::fromString('Foo Bar');
        $expected = null;
        $this->assertEquals($expected, $name->atIndex(3));
    }
}
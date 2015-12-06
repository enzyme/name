<?php

use Enzyme\Name;

class MiddleNameTest extends PHPUnit_Framework_TestCase
{
    public function testGetMiddleFromArgsConstructor()
    {
        $expected = 'Hubert';
        $name = Name::fromArgs('Foo', 'Hubert', 'Bar');
        $this->assertEquals($expected, $name->middle());

        $expected = 'Hubert Cumberdale';
        $name = Name::fromArgs('Foo', 'Hubert', 'Cumberdale', 'Bar');
        $this->assertEquals($expected, $name->middle());
    }

    public function testGetMiddleFromArrayConstructor()
    {
        $expected = 'Hubert';
        $name = Name::fromArray(['Foo', 'Hubert', 'Bar']);
        $this->assertEquals($expected, $name->middle());

        $expected = 'Hubert Cumberdale';
        $name = Name::fromArray(['Foo', 'Hubert', 'Cumberdale', 'Bar']);
        $this->assertEquals($expected, $name->middle());
    }

    public function testGetMiddleFromStringConstructor()
    {
        $expected = 'Hubert';
        $name = Name::fromString('Foo Hubert Bar');
        $this->assertEquals($expected, $name->middle());

        $expected = 'Hubert Cumberdale';
        $name = Name::fromString('Foo Hubert Cumberdale Bar');
        $this->assertEquals($expected, $name->middle());
    }

    public function testGetNonexistentMiddleFromArgsConstructor()
    {
        $expected = null;

        $name = Name::fromArgs('Foo');

        $this->assertEquals($expected, $name->middle());
    }

    public function testGetNonexistentMiddleFromArrayConstructor()
    {
        $expected = null;

        $name = Name::fromArray(['Foo']);

        $this->assertEquals($expected, $name->middle());
    }

    public function testGetLastNonexistentNameFromStringConstructor()
    {
        $expected = null;

        $name = Name::fromString('Foo');

        $this->assertEquals($expected, $name->middle());
    }
}
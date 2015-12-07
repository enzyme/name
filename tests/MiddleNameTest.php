<?php

use Enzyme\Name\Lang\En as Name;

class MiddleNameTest extends PHPUnit_Framework_TestCase
{
    public function testGetMiddleFromArgsConstructor()
    {
        $shorten = true;

        $name = Name::fromArgs('Foo', 'Hubert', 'Bar');
        $expected = 'Hubert';
        $this->assertEquals($expected, $name->middle());
        $expected = 'H.';
        $this->assertEquals($expected, $name->middle($shorten));

        $name = Name::fromArgs('Foo', 'Hubert', 'Cumberdale', 'Bar');
        $expected = 'Hubert Cumberdale';
        $this->assertEquals($expected, $name->middle());
        $expected = 'H. C.';
        $this->assertEquals($expected, $name->middle($shorten));
    }

    public function testGetMiddleFromArrayConstructor()
    {
        $shorten = true;

        $name = Name::fromArray(['Foo', 'Hubert', 'Bar']);
        $expected = 'Hubert';
        $this->assertEquals($expected, $name->middle());
        $expected = 'H.';
        $this->assertEquals($expected, $name->middle($shorten));

        $name = Name::fromArray(['Foo', 'Hubert', 'Cumberdale', 'Bar']);
        $expected = 'Hubert Cumberdale';
        $this->assertEquals($expected, $name->middle());
        $expected = 'H. C.';
        $this->assertEquals($expected, $name->middle($shorten));
    }

    public function testGetMiddleFromStringConstructor()
    {
        $shorten = true;

        $name = Name::fromString('Foo Hubert Bar');
        $expected = 'Hubert';
        $this->assertEquals($expected, $name->middle());
        $expected = 'H.';
        $this->assertEquals($expected, $name->middle($shorten));

        $name = Name::fromString('Foo Hubert Cumberdale Bar');
        $expected = 'Hubert Cumberdale';
        $this->assertEquals($expected, $name->middle());
        $expected = 'H. C.';
        $this->assertEquals($expected, $name->middle($shorten));
    }

    public function testGetMiddleFromStringConstructorOddSpacing()
    {
        $shorten = true;

        $name = Name::fromString(' Foo  Hubert  Bar ');
        $expected = 'Hubert';
        $this->assertEquals($expected, $name->middle());
        $expected = 'H.';
        $this->assertEquals($expected, $name->middle($shorten));

        $name = Name::fromString(' Foo  Hubert      Cumberdale  Bar    ');
        $expected = 'Hubert Cumberdale';
        $this->assertEquals($expected, $name->middle());
        $expected = 'H. C.';
        $this->assertEquals($expected, $name->middle($shorten));
    }

    public function testGetNonexistentMiddleFromArgsConstructor()
    {
        $shorten = true;
        $expected = null;

        $name = Name::fromArgs('Foo');

        $this->assertEquals($expected, $name->middle());
        $this->assertEquals($expected, $name->middle($shorten));
    }

    public function testGetNonexistentMiddleFromArrayConstructor()
    {
        $shorten = true;
        $expected = null;

        $name = Name::fromArray(['Foo']);

        $this->assertEquals($expected, $name->middle());
        $this->assertEquals($expected, $name->middle($shorten));
    }

    public function testGetLastNonexistentNameFromStringConstructor()
    {
        $shorten = true;
        $expected = null;

        $name = Name::fromString('Foo');

        $this->assertEquals($expected, $name->middle());
        $this->assertEquals($expected, $name->middle($shorten));
    }
}
<?php

use Enzyme\Name\Lang\En as Name;

class LastNameTest extends PHPUnit_Framework_TestCase
{
    public function testGetLastNameFromArgsConstructor()
    {
        $shorten = true;
        $name = Name::fromArgs('Foo', 'Bar');

        $expected = 'Bar';
        $this->assertEquals($expected, $name->last());

        $expected = 'B.';
        $this->assertEquals($expected, $name->last($shorten));
    }

    public function testGetLastNameFromArrayConstructor()
    {
        $shorten = true;
        $name = Name::fromArray(['Foo', 'Bar']);

        $expected = 'Bar';
        $this->assertEquals($expected, $name->last());

        $expected = 'B.';
        $this->assertEquals($expected, $name->last($shorten));
    }

    public function testGetLastNameFromStringConstructor()
    {
        $shorten = true;
        $name = Name::fromString('Foo Bar');

        $expected = 'Bar';
        $this->assertEquals($expected, $name->last());

        $expected = 'B.';
        $this->assertEquals($expected, $name->last($shorten));
    }

    public function testGetNonexistentLastNameFromArgsConstructor()
    {
        $shorten = true;
        $expected = null;

        $name = Name::fromArgs('Foo');

        $this->assertEquals($expected, $name->last());
        $this->assertEquals($expected, $name->last($shorten));
    }

    public function testGetNonexistentLastNameFromArrayConstructor()
    {
        $shorten = true;
        $expected = null;

        $name = Name::fromArray(['Foo']);

        $this->assertEquals($expected, $name->last());
        $this->assertEquals($expected, $name->last($shorten));
    }

    public function testGetLastNonexistentNameFromStringConstructor()
    {
        $shorten = true;
        $expected = null;

        $name = Name::fromString('Foo');

        $this->assertEquals($expected, $name->last());
        $this->assertEquals($expected, $name->last($shorten));
    }
}
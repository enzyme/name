<?php

use Enzyme\Name;

class LastNameTest extends PHPUnit_Framework_TestCase
{
    public function testGetLastNameFromArgsConstructor()
    {
        $expected = 'Bar';

        $name = Name::fromArgs('Foo', 'Bar');

        $this->assertEquals($expected, $name->last());
    }

    public function testGetLastNameFromArrayConstructor()
    {
        $expected = 'Bar';

        $name = Name::fromArray(['Foo', 'Bar']);

        $this->assertEquals($expected, $name->last());
    }

    public function testGetLastNameFromStringConstructor()
    {
        $expected = 'Bar';

        $name = Name::fromString('Foo Bar');

        $this->assertEquals($expected, $name->last());
    }

    public function testGetNonexistentLastNameFromArgsConstructor()
    {
        $expected = null;

        $name = Name::fromArgs('Foo');

        $this->assertEquals($expected, $name->last());
    }

    public function testGetNonexistentLastNameFromArrayConstructor()
    {
        $expected = null;

        $name = Name::fromArray(['Foo']);

        $this->assertEquals($expected, $name->last());
    }

    public function testGetLastNonexistentNameFromStringConstructor()
    {
        $expected = null;

        $name = Name::fromString('Foo');

        $this->assertEquals($expected, $name->last());
    }
}
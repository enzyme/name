<?php

use Enzyme\Name\Lang\En as Name;

class FirstNameTest extends PHPUnit_Framework_TestCase
{
    public function testGetFirstNameFromArgsConstructor()
    {
        $shorten = true;
        $name = Name::fromArgs('Foo', 'Bar');

        $expected = 'Foo';
        $this->assertEquals($expected, $name->first());

        $expected = 'F.';
        $this->assertEquals($expected, $name->first($shorten));
    }

    public function testGetFirstNameFromArrayConstructor()
    {
        $shorten = true;
        $name = Name::fromArray(['Foo', 'Bar']);

        $expected = 'Foo';
        $this->assertEquals($expected, $name->first());

        $expected = 'F.';
        $this->assertEquals($expected, $name->first($shorten));
    }

    public function testGetFirstNameFromStringConstructor()
    {
        $shorten = true;
        $name = Name::fromString('Foo Bar');

        $expected = 'Foo';
        $this->assertEquals($expected, $name->first());

        $expected = 'F.';
        $this->assertEquals($expected, $name->first($shorten));
    }

    public function testGetFirstNameFromStringConstructorOddSpacing()
    {
        $shorten = true;
        $name = Name::fromString(' Foo  Bar ');

        $expected = 'Foo';
        $this->assertEquals($expected, $name->first());

        $expected = 'F.';
        $this->assertEquals($expected, $name->first($shorten));
    }
}
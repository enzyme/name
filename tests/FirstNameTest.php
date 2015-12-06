<?php

use Enzyme\Name;

class FirstNameTest extends PHPUnit_Framework_TestCase
{
    public function testGetFirstNameFromArgsConstructor()
    {
        $expected = 'Foo';

        $name = Name::fromArgs('Foo', 'Bar');

        $this->assertEquals($expected, $name->first());
    }

    public function testGetFirstNameFromArrayConstructor()
    {
        $expected = 'Foo';

        $name = Name::fromArray(['Foo', 'Bar']);

        $this->assertEquals($expected, $name->first());
    }

    public function testGetFirstNameFromStringConstructor()
    {
        $expected = 'Foo';

        $name = Name::fromString('Foo Bar');

        $this->assertEquals($expected, $name->first());
    }
}
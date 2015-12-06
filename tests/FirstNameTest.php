<?php

use Enzyme\Name;

class FirstNameTest extends PHPUnit_Framework_TestCase
{
    public function testGetFirstNameFromDefaultConstructor()
    {
        $expected = 'Foo';

        $name = new Name('Foo', 'Bar');

        $this->assertEquals($expected, $name->first());
    }

    public function testGetFirstNameFromDefaultConstructorWithMiddleName()
    {
        $expected = 'Foo';

        $name = new Name('Foo', 'Hubert', 'Bar');

        $this->assertEquals($expected, $name->first());
    }

    public function testGetFirstNameFromStringConstructor()
    {
        $expected = 'Foo';

        $name = Name::fromString('Foo Bar');

        $this->assertEquals($expected, $name->first());
    }

    public function testGetFirstNameFromStringConstructorWithMiddleName()
    {
        $expected = 'Foo';

        $name = Name::fromString('Foo Hubert Bar');

        $this->assertEquals($expected, $name->first());
    }
}
<?php

use Enzyme\Name;

class LastNameTest extends PHPUnit_Framework_TestCase
{
    public function testGetLastNameFromDefaultConstructor()
    {
        $expected = 'Bar';

        $name = new Name('Foo', 'Bar');

        $this->assertEquals($expected, $name->last());
    }

    public function testGetLastNameFromDefaultConstructorWithMiddleName()
    {
        $expected = 'Bar';

        $name = new Name('Foo', 'Hubert', 'Bar');

        $this->assertEquals($expected, $name->last());
    }

    public function testGetLastNameFromStringConstructor()
    {
        $expected = 'Bar';

        $name = Name::fromString('Foo Bar');

        $this->assertEquals($expected, $name->last());
    }

    public function testGetLastNameFromStringConstructorWithMiddleName()
    {
        $expected = 'Bar';

        $name = Name::fromString('Foo Hubert Bar');

        $this->assertEquals($expected, $name->last());
    }
}
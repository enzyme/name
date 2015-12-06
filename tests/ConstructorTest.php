<?php

use Enzyme\Name;

class ConstructorTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorDefault()
    {
        $expected = 'Foo Bar';

        $name = new Name('Foo', 'Bar');

        $this->assertEquals($expected, $name->full());
    }

    public function testConstructorDefaultWithMiddleName()
    {
        $expected = 'Foo H. Bar';

        $name = new Name('Foo', 'H.', 'Bar');

        $this->assertEquals($expected, $name->full());
    }

    public function testConstructorFromString()
    {
        $expected = 'Foo Bar';

        $name = Name::fromString($expected);

        $this->assertEquals($expected, $name->full());
    }
}
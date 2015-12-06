<?php

use Enzyme\Name;

class ConstructorTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorFromArgs()
    {
        $expected = 'Foo';
        $name = Name::fromArgs('Foo');
        $this->assertEquals($expected, $name->full());

        $expected = 'Foo Bar';
        $name = Name::fromArgs('Foo', 'Bar');
        $this->assertEquals($expected, $name->full());

        $expected = 'Foo Hubert Bar';
        $name = Name::fromArgs('Foo', 'Hubert', 'Bar');
        $this->assertEquals($expected, $name->full());
    }

    public function testConstructorFromArray()
    {
        $expected = 'Foo';
        $name = Name::fromArray(['Foo']);
        $this->assertEquals($expected, $name->full());

        $expected = 'Foo Bar';
        $name = Name::fromArray(['Foo', 'Bar']);
        $this->assertEquals($expected, $name->full());

        $expected = 'Foo Hubert Bar';
        $name = Name::fromArray(['Foo', 'Hubert', 'Bar']);
        $this->assertEquals($expected, $name->full());
    }

    public function testConstructorFromString()
    {
        $expected = 'Foo';
        $name = Name::fromString($expected);
        $this->assertEquals($expected, $name->full());

        $expected = 'Foo Bar';
        $name = Name::fromString($expected);
        $this->assertEquals($expected, $name->full());

        $expected = 'Foo Hubert Bar';
        $name = Name::fromString($expected);
        $this->assertEquals($expected, $name->full());
    }
}
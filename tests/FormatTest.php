<?php

use Enzyme\Name\Simple;
use Enzyme\Name\Format;

class FormatTest extends PHPUnit_Framework_TestCase
{
    public function testFirstNameFormat()
    {
        $first = 'Hubert';
        $name = Simple::fromString($first);
        $fmt = new Format($name);

        $expected = 'Hubert';
        $this->assertEquals($expected, $fmt->like('First'));

        $expected = 'H.';
        $this->assertEquals($expected, $fmt->like('F.'));
    }

    public function testFormatQuickfire()
    {
        $first = 'Hubert';
        $name = Simple::fromString($first);

        $expected = 'Hubert';
        $this->assertEquals($expected, Format::nameLike($name, 'First'));

        $expected = 'H.';
        $this->assertEquals($expected, Format::nameLike($name, 'F.'));
    }

    public function testFirstAndLastNameFormat()
    {
        $string = 'Hubert Cumberdale';
        $name = Simple::fromString($string);
        $fmt = new Format($name);

        $expected = 'Hubert Cumberdale';
        $this->assertEquals($expected, $fmt->like('First Last'));

        $expected = 'H. C.';
        $this->assertEquals($expected, $fmt->like('F. L.'));

        $expected = 'Hubert C.';
        $this->assertEquals($expected, $fmt->like('First L.'));

        $expected = 'Cumberdale, H.';
        $this->assertEquals($expected, $fmt->like('Last, F.'));
    }

    public function testFirstMiddleAndLastNameFormat()
    {
        $string = 'Hubert Alfred Cumberdale';
        $name = Simple::fromString($string);
        $fmt = new Format($name);

        $expected = 'Hubert Alfred Cumberdale';
        $this->assertEquals($expected, $fmt->like('First Middle Last'));

        $expected = 'H. A. C.';
        $this->assertEquals($expected, $fmt->like('F. M. L.'));

        $expected = 'Hubert A. C.';
        $this->assertEquals($expected, $fmt->like('First M. L.'));

        $expected = 'Cumberdale, H. A.';
        $this->assertEquals($expected, $fmt->like('Last, F. M.'));
    }

    public function testFirstMultiMiddleAndLastNameFormat()
    {
        $string = 'Hubert Alfredo Smith Cumberdale';
        $name = Simple::fromString($string);
        $fmt = new Format($name);

        $expected = 'Hubert Alfredo Smith Cumberdale';
        $this->assertEquals($expected, $fmt->like('First Middle Last'));

        $expected = 'H. A. S. C.';
        $this->assertEquals($expected, $fmt->like('F. M. L.'));

        $expected = 'Hubert A. S. C.';
        $this->assertEquals($expected, $fmt->like('First M. L.'));

        $expected = 'Cumberdale, H. A. S.';
        $this->assertEquals($expected, $fmt->like('Last, F. M.'));
    }

    public function testPrefixFirstMiddleAndLastNameFormat()
    {
        $string = 'Dr. Hubert Alfred Cumberdale';
        $name = Simple::fromString($string);
        $fmt = new Format($name);

        $expected = 'Dr. Hubert Alfred Cumberdale';
        $this->assertEquals($expected, $fmt->like('Prefix First Middle Last'));

        $expected = 'Dr. H. A. C.';
        $this->assertEquals($expected, $fmt->like('P. F. M. L.'));

        $expected = 'Dr. Hubert A. C.';
        $this->assertEquals($expected, $fmt->like('Prefix First M. L.'));

        $expected = 'Dr. Cumberdale, H. A.';
        $this->assertEquals($expected, $fmt->like('Prefix Last, F. M.'));
    }

    public function testPrefixFirstMiddleAndLastNameFormatWithOddSpacing()
    {
        $string = 'Dr. Hubert Alfred Cumberdale';
        $name = Simple::fromString($string);
        $fmt = new Format($name);

        $expected = 'Dr. Hubert Alfred Cumberdale';
        $this->assertEquals($expected, $fmt->like('  Prefix   First Middle  Last       '));

        $expected = 'Dr. H. A. C.';
        $this->assertEquals($expected, $fmt->like(' P.        F.  M.   L.'));

        $expected = 'Dr. Hubert A. C.';
        $this->assertEquals($expected, $fmt->like('Prefix           First M. L.'));

        $expected = 'Dr. Cumberdale, H. A.';
        $this->assertEquals($expected, $fmt->like('Prefix Last,     F. M.'));
    }

    public function testPrefixFirstMiddleAndLastNameFormatWithOddSpacingAndUnicode()
    {
        $string = 'Dr. Hubert Alfred Cumberdale';
        $name = Simple::fromString($string);
        $fmt = new Format($name);

        $expected = '☂ Dr. Hubert Alfred Cumberdale';
        $this->assertEquals($expected, $fmt->like('☂  Prefix   First Middle  Last       '));

        $expected = '☂ Dr. H. A. C.';
        $this->assertEquals($expected, $fmt->like('☂ P.        F.  M.   L.'));

        $expected = '☂ Dr. Hubert A. C.';
        $this->assertEquals($expected, $fmt->like('☂ Prefix           First M. L.'));

        $expected = '☂ Dr. Cumberdale, H. A.';
        $this->assertEquals($expected, $fmt->like('☂ Prefix Last,     F. M.'));
    }
}
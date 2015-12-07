<?php

use Enzyme\Name\Formatter;
use Enzyme\Name\Lang\En as Name;

class FormatterTest extends PHPUnit_Framework_TestCase
{
    public function testFirstNameFormatShort()
    {
        $expected = 'H.';

        $name = Name::fromString('Hubert Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('F.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'F.'));
    }

    public function testFirstNameFormatLong()
    {
        $expected = 'Hubert';

        $name = Name::fromString('Hubert Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('First'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'First'));
    }

    public function testLastNameFormatShort()
    {
        $expected = 'C.';

        $name = Name::fromString('Hubert Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('L.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'L.'));
    }

    public function testLastNameFormatLong()
    {
        $expected = 'Cumberdale';

        $name = Name::fromString('Hubert Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('Last'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'Last'));
    }

    public function testFirstAndLastNameFormatShort()
    {
        $expected = 'H. C.';

        $name = Name::fromString('Hubert Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('F. L.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'F. L.'));
    }

    public function testFirstAndLastNameFormatLong()
    {
        $expected = 'Hubert Cumberdale';

        $name = Name::fromString('Hubert Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('First Last'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'First Last'));
    }

    public function testFullFirstAndShortLastNameFormat()
    {
        $expected = 'Hubert C.';

        $name = Name::fromString('Hubert Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('First L.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'First L.'));
    }

    public function testMiddleNameFormatLong()
    {
        $expected = 'Alfred';

        $name = Name::fromString('Hubert Alfred Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('Middle'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'Middle'));
    }

    public function testMiddleNameFormatShort()
    {
        $expected = 'A.';

        $name = Name::fromString('Hubert Alfred Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('M.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'M.'));
    }

    public function testMultipleMiddleNameFormatLong()
    {
        $expected = 'Alfred Smith';

        $name = Name::fromString('Hubert Alfred Smith Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('Middle'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'Middle'));
    }

    public function testMultipleMiddleNameFormatShort()
    {
        $expected = 'A. S.';

        $name = Name::fromString('Hubert Alfred Smith Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('M.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'M.'));
    }

    public function testFullNameFormatMixedShortMiddle()
    {
        $expected = 'Hubert A. S. Cumberdale';

        $name = Name::fromString('Hubert Alfred Smith Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('First M. Last'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'First M. Last'));
    }

    public function testFullNameFormatMixedAlternateStructure()
    {
        $expected = 'Cumberdale, H. A. S.';

        $name = Name::fromString('Hubert Alfred Smith Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('Last, F. M.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'Last, F. M.'));
    }

    public function testFullNameFormatMixedAlternateStructureVariant()
    {
        $expected = 'Cumberdale - H. A. S.';

        $name = Name::fromString('Hubert Alfred Smith Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('Last - F. M.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'Last - F. M.'));
    }

    public function testFullNameFormatMixedAlternateStructureVariantOddSpacing()
    {
        $expected = 'Cumberdale - H. A. S.';

        $name = Name::fromString('Hubert Alfred Smith Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('Last  -  F. M.'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'Last  -  F. M.'));
    }

    public function testFullNameFormatMissingNamePartsRequested()
    {
        $expected = 'Hubert Cumberdale';

        $name = Name::fromString('Hubert Cumberdale');
        $formatter = new Formatter($name);

        $this->assertEquals($expected, $formatter->like('First Middle Last'));
        $this->assertEquals($expected, Formatter::nameLike($name, 'First Middle Last'));
    }
}
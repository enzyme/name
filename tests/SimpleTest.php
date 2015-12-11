<?php

use Enzyme\Name\Simple;
use Enzyme\Name\Part;

class SimpleTest extends PHPUnit_Framework_TestCase
{
    public function testSimpleNameStoresCorrectStrictData()
    {
        $prefix = new Part('Mr.');
        $first = new Part('Hubert');
        $middle = new Part('Alfred');
        $last = new Part('Cumberdale');

        $name = Simple::strict()
            ->prefix($prefix)
            ->first($first)
            ->middle($middle)
            ->last($last);

        $this->assertEquals($prefix->long(), $name->getPrefix()->long());
        $this->assertEquals($first->long(), $name->getFirst()->long());
        $this->assertEquals($middle->long(), $name->getMiddle()->long());
        $this->assertEquals($last->long(), $name->getLast()->long());
    }

    public function testSimpleNameStoresCorrectArgsData()
    {
        $prefix = 'Mr.';
        $first = 'Hubert';
        $middle = 'Alfred';
        $last = 'Cumberdale';

        $name = Simple::fromArgs($prefix, $first, $middle, $last);
        $this->assertEquals($prefix, $name->getPrefix()->long());
        $this->assertEquals($first, $name->getFirst()->long());
        $this->assertEquals($middle, $name->getMiddle()->long());
        $this->assertEquals($last, $name->getLast()->long());

        $name = Simple::fromArgs($first, $middle, $last);
        $this->assertEquals(null, $name->getPrefix());
        $this->assertEquals($first, $name->getFirst()->long());
        $this->assertEquals($middle, $name->getMiddle()->long());
        $this->assertEquals($last, $name->getLast()->long());

        $name = Simple::fromArgs($first, $last);
        $this->assertEquals(null, $name->getPrefix());
        $this->assertEquals($first, $name->getFirst()->long());
        $this->assertEquals(null, $name->getMiddle());
        $this->assertEquals($last, $name->getLast()->long());

        $name = Simple::fromArgs($first);
        $this->assertEquals(null, $name->getPrefix());
        $this->assertEquals($first, $name->getFirst()->long());
        $this->assertEquals(null, $name->getMiddle());
        $this->assertEquals(null, $name->getLast());
    }

    public function testSimpleNameStoresCorrectStringData()
    {
        $prefix = new Part('Mr.');
        $first = new Part('Hubert');
        $middle = new Part('Alfred');
        $last = new Part('Cumberdale');

        $name = Simple::fromString('Mr. Hubert Alfred Cumberdale');
        $this->assertEquals($prefix->long(), $name->getPrefix()->long());
        $this->assertEquals($first->long(), $name->getFirst()->long());
        $this->assertEquals($middle->long(), $name->getMiddle()->long());
        $this->assertEquals($last->long(), $name->getLast()->long());

        $name = Simple::fromString('Hubert Alfred Cumberdale');
        $this->assertEquals(null, $name->getPrefix());
        $this->assertEquals($first->long(), $name->getFirst()->long());
        $this->assertEquals($middle->long(), $name->getMiddle()->long());
        $this->assertEquals($last->long(), $name->getLast()->long());

        $name = Simple::fromString('Hubert Cumberdale');
        $this->assertEquals(null, $name->getPrefix());
        $this->assertEquals($first->long(), $name->getFirst()->long());
        $this->assertEquals(null, $name->getMiddle());
        $this->assertEquals($last->long(), $name->getLast()->long());

        $name = Simple::fromString('Hubert');
        $this->assertEquals(null, $name->getPrefix());
        $this->assertEquals($first->long(), $name->getFirst()->long());
        $this->assertEquals(null, $name->getMiddle());
        $this->assertEquals(null, $name->getLast());
    }

    /**
     * @expectedException \Enzyme\Name\NameException
     */
    public function testSimpleNameThrowsExceptionOnIncorrectArgsData()
    {
        $name = Simple::fromArgs('a', 'b', 'c', 'd', 'e');
    }

    /**
     * @expectedException \Enzyme\Name\NameException
     */
    public function testSimpleNameThrowsExceptionOnZeroArgsData()
    {
        $name = Simple::fromArgs();
    }

    /**
     * @expectedException \Enzyme\Name\NameException
     */
    public function testSimpleNameThrowsExceptionOnIncorrectStringData()
    {
        $name = Simple::fromString('');
    }
}
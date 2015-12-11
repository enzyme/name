<?php

use Enzyme\Name\Part;

class PartTest extends PHPUnit_Framework_TestCase
{
    public function testPartReturnsCorrectLongData()
    {
        $first = 'Hubert';
        $part = new Part($first);

        $this->assertEquals($first, $part->long());
    }

    public function testPartReturnsCorrectShortData()
    {
        $first = 'Hubert';
        $short = 'H.';
        $part = new Part($first);

        $this->assertEquals($short, $part->short());
    }

    public function testPartReturnsCorrectShortDataWhenPeriodDefined()
    {
        $first = 'Mr.';
        $short = 'Mr.';
        $part = new Part($first);

        $this->assertEquals($short, $part->short());
    }
}
<?php


namespace App\Tests\Classes;


use App\Classes\Month;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    public function testFirstDay(){
        $month = new Month(1,2020);
        $this->assertEquals(1,$month->getFirstDay()->format("d"));

    }
    public function testLastDayMonthBysextil(){
        $month = new Month(2,2020);
        $this->assertEquals(29,$month->getLastDay()->format("d"));
    }
    public function testLastDayMonth31(){
        $month = new Month(3,2020);
        $this->assertEquals(31,$month->getLastDay()->format("d"));
        $month = new Month(5,2020);
        $this->assertEquals(31,$month->getLastDay()->format("d"));
    }

    public function testNumberWeeks()
    {
        $month = new Month(10,2021);
        $this->assertEquals(5,$month->getWeeks());

        $month = new Month(12,2021);
        $this->assertEquals(5,$month->getWeeks());

        $month = new Month(1,2022);
        $this->assertEquals(6,$month->getWeeks());

        $month = new Month(2,2021);
        $this->assertEquals(4,$month->getWeeks());
    }

    public function testFirstIndex()
    {
        $month = new Month(10,2021);
        $this->assertEquals(-4, $month->getFirstIndex());
    }
}
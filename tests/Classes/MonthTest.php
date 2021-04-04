<?php


namespace App\Tests\Classes;


use App\Classes\Month;

class MonthTest extends \PHPUnit\Framework\TestCase
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
}
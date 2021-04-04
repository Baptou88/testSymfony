<?php


namespace App\Classes;


use App\Repository\HeureProjetRepository;

class TableauMois
{
    /**
     * @var Month
     */
    private Month $month;
    /**
     * @var HeureProjetRepository
     */
    private HeureProjetRepository $repository;

    public function __construct(Month $month, HeureProjetRepository $repository) {

        $this->month = $month;
        $this->repository = $repository;
    }
    public function getData(){

    }
}
<?php


namespace App\Controller\Gantt;


class Gantt
{

    private $rows = 5;
    private $cols = 5;

    public function __construct(){


    }

    /**
     * @return mixed
     */
    public function getRows(): int
    {
        return $this->rows;
    }

    /**
     * @param mixed $rows
     */
    public function setRows($rows): self
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * @return int
     */
    public function getCols(): int
    {
        return $this->cols;
    }

    /**
     * @param int $cols
     */
    public function setCols(int $cols): self
    {
        $this->cols = $cols;
        return $this;
    }



}
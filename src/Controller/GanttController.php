<?php

namespace App\Controller;

use App\Controller\Gantt\Gantt;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GanttController extends AbstractController
{

    /**
     * @Route("/gantt", name="gantt")
     */
    public function index(): Response
    {
        $gantt = new Gantt();
        $gantt = $gantt
            ->setCols(2)
            ->setRows(4);
        $rows = 2;
        $cols = 4;
        return $this->render('gantt/index.html.twig', [
            'controller_name' => 'GanttController',
            'rows' => $rows,
            'cols' => $cols,
            'gantt' => $gantt
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController  extends AbstractController
{
    /**
     * index
     * @Route("/Projects" , name="Projects.index" ) 
     * @return Response
     */
    public function index():Response
    {
        return $this->render('projects/index.html.twig', [
            'current_menu' => 'projects'
        ]);
    }
}

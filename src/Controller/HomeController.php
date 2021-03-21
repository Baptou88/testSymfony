<?php

namespace App\Controller;

use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController  extends AbstractController
{
    

    
    public function index(ProjectsRepository $repository): Response   
    {
         $projects = $repository->findLatest();
        
        return $this->render('pages/home.html.twig', [
            'projects' => $projects
        ]);
    }
}

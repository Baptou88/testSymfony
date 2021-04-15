<?php

namespace App\Controller;

use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController  extends AbstractController
{
    

    
    public function index(ProjectsRepository $repository): Response   
    {
         $projects = $repository->findLatest();
//        $object = new \COM('TestPhp.Class1');
//        //$object = new \DOTNET('TestPhp','Class1');
//        dump($object->HelloWorld());
//        dump($object->Connect());
//        dump($object->IsConnected());
//        dump($object->Document());
//        $object->Disconnect();
        return $this->render('pages/home.html.twig', [
            'projects' => $projects,

        ]);
    }

    /**
     * @Route("/Apropos")
     * @return Response
     */
    public function Apropos():Response
    {
        return new Response(phpinfo());
    }

}

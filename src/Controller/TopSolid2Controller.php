<?php

namespace App\Controller;


use App\Service\CallTopSolidApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopSolid2Controller extends AbstractController
{



    #[Route('/top/solid2', name: 'top_solid2')]
    public function index(CallTopSolidApi $callTopSolidApi): Response
    {

        $projectTS = $callTopSolidApi->getProjects();
        dump($projectTS);
        return $this->render('TopSolid/index.html.twig', [
            'controller_name' => 'TopSolid2Controller',
            'current_menu' => 'TopSolid2',
            'projectTS'=>$projectTS
        ]);
    }
    public function searchproject(CallTopSolidApi  $callTopSolidApi, String $projectName){

    }
}

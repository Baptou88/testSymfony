<?php


namespace App\Controller\api;



use App\Repository\ProjectsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController
{
    #[Route('/api/projects', name: 'api_projects')]
    public function index(Request $request, ProjectsRepository $repository)
    {
        return "";
    }
}
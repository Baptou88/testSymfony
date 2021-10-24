<?php


namespace App\Controller\api;



use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    #[Route('/api/projects', name: 'api_projects')]
    public function index(Request $request, ProjectsRepository $repository)
    {

        return $this->json($repository->search($request->get("q")));
    }
}
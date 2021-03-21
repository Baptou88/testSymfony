<?php

namespace App\Controller;

use App\Entity\Projects;
use App\Repository\ProjectsRepository;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method index
 */
class ProjectController  extends AbstractController
{
    private $repository;
    private $em;
    /**
     *
     * @var PropertyRository
     */
    

    public function __construct(ProjectsRepository $repository)
    {
        $this->repository = $repository;
        // $this->em = $em;
    }
    /**
     * index
     * @Route("/Projects" , name="Projects.index" ) 
     * @return Response
     */
    public function index():Response
    {
        // $Projet = new Projects;
        // $Projet->setCode("121/A")
        //     ->setDateEntree(new DateTime())
        //     ->setDateDelai(new DateTime())
        //     ->settype(1);
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($Projet);
        // $em->flush();
        $repository = $this->getDoctrine()->getRepository(Projects::class);
        $Projet = $this->repository->find(1);
        //dump($Projet);
        //dump($repository);
        return $this->render('projects/index.html.twig', [
            'current_menu' => 'projects'
        ]);
    }

    /**
     * index
     * @Route("/Projects/{slug}-{id}" , name="Projects.show", requirements={"slug": "[a-z0-9\-]*"} ) 
     * @return Response
     */
    public function show($slug, $id): Response
    {
        
        $projet = $this->repository->find($id);
        
        if ($projet->getSlug() !== $slug) {
            
            return $this->redirectToRoute('Projects.show',[
                'id' => $projet->getId(),
                'slug' => $projet->getSlug()
            ],301);
        }
        return $this->render('projects/show.html.twig', [
            'projet' => $projet,
            'current_menu' => 'projects'
        ]);
    }
}

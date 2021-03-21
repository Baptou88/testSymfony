<?php

namespace App\Controller\Admin;

use App\Entity\Projects;
use App\Form\ProjectType;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminProjectController  extends AbstractController
{
    private $repository ;
    private $em;

    public function __construct(ProjectsRepository $repository, EntityManagerInterface $em )
    {
        $this->repository = $repository;
        $this->em =$em;
    }

    /**
     * @Route("/admin" , name="admin.Projects.index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $projects = $this->repository->findAll();
        return $this->render('admin/projects/index.html.twig', compact('projects',$projects));
    }

    /**
     * @Route("/admin/Projects/new" , name="admin.Projects.new")
     *
     * @return Response
     */
    public function new(Request $request)
    {
        $project = new Projects();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($project);
            $this->em->flush();
            $this->addFlash('success','Créer avec succés');
            return $this->redirectToRoute('admin.Projects.index',[],301);
        }
        return $this->render('admin/projects/new.html.twig',[
            'project' => $project,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/Projects/{id}" , name="admin.Projects.edit", methods="GET|POST")
     * @param Projects $project
     * @param Request $request
     * @return Response
     */
    public function edit(Projects $project, Request $request): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->em->flush();
            $this->addFlash('success','Modifié avec succés');
            return $this->redirectToRoute('admin.Projects.index',[],301);
        }

        return $this->render('admin/projects/edit.html.twig',[
            'project' => $project,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/Projects/{id}" , name="admin.Projects.delete", methods="DELETE")
     * @param Projects $project
     * @param Request $request
     * @return Response
     */
    public function delete(Projects $project, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $project->getId() , $request->get('_token'))) {
           $this->em->remove($project);
            $this->em->flush();
            return $this->redirectToRoute('admin.Projects.index',[],301);
            $this->addFlash('success','supprimé avec succés');
            return new Response("suppr"); 
        } else {
            return new Response("fail to delete");
        }
        
    }
}

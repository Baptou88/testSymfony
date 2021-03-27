<?php

namespace App\Controller;


use App\Entity\ProjectSearch;
use App\Form\ProjectSearchType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class ProjectController  extends AbstractController
{

    private $em;


    private $repository;

    public function __construct(ProjectsRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
         $this->em = $em;
    }
    /**
     * index
     * @Route("/Projects" , name="Projects.index" ) 
     * @return Response
     *
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
    {
        // $Projet = new Projects;
        // $Projet->setCode("121/A")
        //     ->setDateEntree(new DateTime())
        //     ->setDateDelai(new DateTime())
        //     ->settype(1);
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($Projet);
        // $em->flush();
        //$repository = $this->getDoctrine()->getRepository(Projects::class);
        $search = new ProjectSearch();
        $form = $this->createForm(ProjectSearchType::class, $search);
        $form->handleRequest($request);
        $query = $this->repository->findAllVisible($search);

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        //dump($Projet);
        //dump($repository);
        return $this->render('projects/index.html.twig', [
            'current_menu' => 'projects',
            'projects' => $pagination,
            'form' => $form->createView()
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
        dump($this->repository->findOneByIdJoinedClient($id));
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

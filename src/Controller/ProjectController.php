<?php

namespace App\Controller;


use App\Entity\ProjectSearch;
use App\Form\ProjectSearchType;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ProjectController  extends AbstractController
{

    private EntityManagerInterface $em;
    private ProjectsRepository $repository;

    public function __construct(ProjectsRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
         $this->em = $em;
    }

    /**
     * index
     * @Route("/Projects" , name="Projects.index" )
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
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
     * show
     * @Route("/Projects/{slug}-{id}" , name="Projects.show", requirements={"slug": "[a-z0-9\-]*"} )
     * @param $slug
     * @param $id
     * @return Response
     */
    public function show($slug, $id): Response
    {


        $projet = $this->repository->find($id);
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        dump($serializer->serialize($projet,'json', [AbstractNormalizer::ATTRIBUTES => ['code', 'id']]));
    //dump($projet);

        if ($projet->getSlug() !== $slug) {
            
            return $this->redirectToRoute('Projects.show',[
                'id' => $projet->getId(),
                'slug' => $projet->getSlug()
            ],301);
        }
        $heureprojects = $projet->getHeureProjets()->getValues();
        return $this->render('projects/show.html.twig', [
            'projet' => $projet,
            'current_menu' => 'projects',
            'heureprojects' => $heureprojects
        ]);
    }

    /**
     * pdf
     * @Route("/Projects/{slug}-{id}/pdf" , name="Projects.pdf" , requirements={"slug": "[a-z0-9\-]*"})
     * @param $slug
     * @param $id
     * @return Response
     */
    public function pdf($slug, $id): Response
    {
        $projet = $this->repository->find($id);
        dump($this->repository->findOneByIdJoinedClient($id));
        if ($projet->getSlug() !== $slug) {

            return $this->redirectToRoute('Projects.show',[
                'id' => $projet->getId(),
                'slug' => $projet->getSlug()
            ],301);
        }
        $heureprojects = $projet->getHeureProjets()->getValues();

        $options = new Options();
        $options->set('defaultFont', 'Roboto');

        // instantiate and use the dompdf class
        $dompdf = new Dompdf($options);
        $html = $this->renderView('pdf/project.html.twig',[
            'title' => "titrepdf",
            'project' => $projet
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("document.pdf", [
            "Attachment" => false
        ]);

        /*return new Response($dompdf->stream("doc"), [
            "Attachment" => false
        ]);*/
        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);

    }

    /**
     * pdf
     * @Route("/Projects/{slug}-{id}/json" , name="Projects.json" , requirements={"slug": "[a-z0-9\-]*"})
     * @param $slug
     * @param $id
     * @return JsonResponse
     */
        public function jsonn($slug, $id): JsonResponse
    {
        $projet = $this->repository->find($id);
        dump($this->repository->findOneByIdJoinedClient($id));
        /*if ($projet->getSlug() !== $slug) {

            return $this->redirectToRoute('Projects.show',[
                'id' => $projet->getId(),
                'slug' => $projet->getSlug()
            ],301);
        }*/
        $heureprojects = $projet->getHeureProjets()->getValues();



        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($projet, 'json',[
            AbstractNormalizer::ATTRIBUTES => ['code', 'id','DateEntree','DateDelai','TypeProjet','description'],
            /*AbstractObjectNormalizer::ENABLE_MAX_DEPTH => false*/
        ]);
        //return new JsonResponse($json);
        return new JsonResponse($json,200,[],true);

    }
}

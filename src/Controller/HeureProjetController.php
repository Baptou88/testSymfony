<?php

namespace App\Controller;

use App\Classes\Month;
use App\Entity\HeureProjet;
use App\Form\HeureProjetType;
use App\Repository\HeureProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/heureprojet")
 */
class HeureProjetController extends AbstractController
{
    /**
     * @Route("/", name="heure_projet_index", methods={"GET"})
     * @param HeureProjetRepository $heureProjetRepository
     * @return Response
     */
    public function index(HeureProjetRepository $heureProjetRepository): Response
    {
        $month = new Month(4,2021);
        dump($heureProjetRepository->findbymonth($month));
        return $this->render('heure_projet/index.html.twig', [
            'heure_projets' => $heureProjetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="heure_projet_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $heureProjet = new HeureProjet();
        $form = $this->createForm(HeureProjetType::class, $heureProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($heureProjet);
            $entityManager->flush();

            return $this->redirectToRoute('heure_projet_index');
        }

        return $this->render('heure_projet/new.html.twig', [
            'heure_projet' => $heureProjet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="heure_projet_show", methods={"GET"})
     */
    public function show(HeureProjet $heureProjet): Response
    {
        return $this->render('heure_projet/show.html.twig', [
            'heure_projet' => $heureProjet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="heure_projet_edit", methods={"GET","POST"})
     * @param Request $request
     * @param HeureProjet $heureProjet
     * @return Response
     */
    public function edit(Request $request, HeureProjet $heureProjet): Response
    {
        $form = $this->createForm(HeureProjetType::class, $heureProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('heure_projet_index');
        }

        return $this->render('heure_projet/edit.html.twig', [
            'heure_projet' => $heureProjet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="heure_projet_delete", methods={"DELETE"})
     * @param Request $request
     * @param HeureProjet $heureProjet
     * @return Response
     */
    public function delete(Request $request, HeureProjet $heureProjet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$heureProjet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($heureProjet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('heure_projet_index');
    }
}

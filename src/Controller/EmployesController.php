<?php

namespace App\Controller;

use App\Classes\Month;
use App\Entity\Employes;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use App\Repository\HeureProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employes')]
class EmployesController extends AbstractController
{
    #[Route('/', name: 'employes_index', methods: ['GET'])]
    public function index(EmployesRepository $employesRepository): Response
    {
        return $this->render('employes/index.html.twig', [
            'employes' => $employesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'employes_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $employe = new Employes();
        $form = $this->createForm(EmployesType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('employes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employes/new.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'employes_show', methods: ['GET'])]
    public function show(Employes $employe, HeureProjetRepository $heureProjetRepository): Response
    {
        $Month = new Month(10,2021);
        $heureprojets = $heureProjetRepository->findbymonth($Month,$employe->getId());
        dump($heureprojets);
        return $this->render('employes/show.html.twig', [
            'employe' => $employe,
            'Month' => $Month,
            'heureprojects' => $heureprojets
        ]);
    }

    #[Route('/{id}/edit', name: 'employes_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Employes $employe): Response
    {
        $form = $this->createForm(EmployesType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employes/edit.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'employes_delete', methods: ['POST'])]
    public function delete(Request $request, Employes $employe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employes_index', [], Response::HTTP_SEE_OTHER);
    }
}

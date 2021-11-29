<?php

namespace App\Controller;

use App\Entity\NatureRecette;
use App\Form\NatureRecetteType;
use App\Repository\NatureRecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/nature/recette')]
class NatureRecetteController extends AbstractController
{
    #[Route('/', name: 'nature_recette_index', methods: ['GET'])]
    public function index(NatureRecetteRepository $natureRecetteRepository): Response
    {
        return $this->render('nature_recette/index.html.twig', [
            'nature_recettes' => $natureRecetteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'nature_recette_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $natureRecette = new NatureRecette();
        $form = $this->createForm(NatureRecetteType::class, $natureRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($natureRecette);
            $entityManager->flush();

            return $this->redirectToRoute('nature_recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nature_recette/new.html.twig', [
            'nature_recette' => $natureRecette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'nature_recette_show', methods: ['GET'])]
    public function show(NatureRecette $natureRecette): Response
    {
        return $this->render('nature_recette/show.html.twig', [
            'nature_recette' => $natureRecette,
        ]);
    }

    #[Route('/{id}/edit', name: 'nature_recette_edit', methods: ['GET','POST'])]
    public function edit(Request $request, NatureRecette $natureRecette): Response
    {
        $form = $this->createForm(NatureRecetteType::class, $natureRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nature_recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nature_recette/edit.html.twig', [
            'nature_recette' => $natureRecette,
            'form' => $form,
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'nature_recette_delete', methods: ['POST'])]
    public function delete(Request $request, NatureRecette $natureRecette): Response
    {
        if ($this->isCsrfTokenValid('nature_recette_deletion_'.$natureRecette->getId(), $request->request->get('csrf_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($natureRecette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nature_recette_index', [], Response::HTTP_SEE_OTHER);
    }
}

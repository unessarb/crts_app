<?php

namespace App\Controller;

use App\Entity\NatureOperationDepense;
use App\Form\NatureOperDepenseType;
use App\Repository\NatureOperationDepenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/nature/depense')]
class NatureDepenseController extends AbstractController
{
    #[Route('/', name: 'app_nature_operation_depense', methods: ['GET'])]
    public function index(NatureOperationDepenseRepository $NatureOperationDepenseRepository): Response
    {
        return $this->render('nature_depense/index.html.twig', [
            'nature_depenses' => $NatureOperationDepenseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_new_nature_operation_depense', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $naturedepense = new NatureOperationDepense();
        $form = $this->createForm(NatureOperDepenseType::class, $naturedepense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($naturedepense);
            $entityManager->flush();

            return $this->redirectToRoute('app_nature_operation_depense', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nature_depense/new.html.twig', [
            'nature_depense' => $naturedepense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_show_nature_operation_depense', methods: ['GET'])]
    public function show(NatureOperationDepense $naturedepense): Response
    {
        return $this->render('nature_depense/show.html.twig', [
            'nature_depense' => $naturedepense,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_edit_nature_operation_depense', methods: ['GET','POST'])]
    public function edit(Request $request, NatureOperationDepense $naturedepense): Response
    {
        $form = $this->createForm(NatureOperDepenseType::class, $naturedepense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_nature_operation_depense', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nature_depense/edit.html.twig', [
            'nature_depense' => $naturedepense,
            'form' => $form,
        ]);
    }

    #[Route('/{id<[0-9]+>}', name: 'app_delete_nature_operation_depense', methods: ['POST'])]
    public function delete(Request $request, NatureOperationDepense $naturedepense): Response
    {
        if ($this->isCsrfTokenValid('nature_depense_deletion_'.$naturedepense->getId(), $request->request->get('csrf_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($naturedepense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_nature_operation_depense', [], Response::HTTP_SEE_OTHER);
    }
}

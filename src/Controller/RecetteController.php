<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/recettes', name: 'app_recettes')]
    public function index(RecetteRepository $recetteRepository): Response
    {
        $recettes = $recetteRepository->findAll();
        return $this->render('recette/index.html.twig', [
            'recettes' => $recettes,
        ]);
    }

    #[Route('/recettes/new', name: 'app_new_recettes', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $recette = new Recette;
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->persist($recette);
            $em->flush();

            $this->addFlash('success', 'Ajouté avec succès !');

            return $this->redirectToRoute('app_recettes');
        }
        return $this->render('recette/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/recettes/edit/{id<[0-9]+>}', name: 'app_edit_recettes', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,Recette $recette): Response
    {
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Modifié avec succès !');
            return $this->redirectToRoute('app_recettes');
            
        }
        return $this->render('recette/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/recettes/{id<[0-9]+>}', name: 'app_recettes_delete', methods: ["POST"])]
    public function delete(Request $request, Recette $recette, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('recette_deletion_' . $recette->getId(), $request->request->get('csrf_token'))) {
            $em->remove($recette);
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_recettes');
    }
}
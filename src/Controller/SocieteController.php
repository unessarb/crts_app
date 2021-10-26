<?php

namespace App\Controller;

use App\Entity\Societe;
use App\Form\SocieteType;
use App\Repository\SocieteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SocieteController extends AbstractController
{
    #[Route('/societes', name: 'app_societes')]
    public function index(SocieteRepository $societeRepository): Response
    {
        $societes = $societeRepository->findBy([], ["createdAt"=>"desc"]);
        return $this->render('societe/index.html.twig', [
            'societes' => $societes,
        ]);
    }

    #[Route('/societes/new', name: 'app_new_societes', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $societe = new Societe;
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->persist($societe);
            $em->flush();

            $this->addFlash('success', 'Société ajoutée avec succès !');

            return $this->redirectToRoute('app_societes');
        }
        return $this->render('societe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/societes/edit/{id<[0-9]+>}', name: 'app_edit_societes', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,Societe $societe): Response
    {
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Société modifiée avec succès !');
            return $this->redirectToRoute('app_societes');
            
        }
        return $this->render('societe/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/societes/{id<[0-9]+>}', name: 'app_societes_delete', methods: ["POST"])]
    public function delete(Request $request, Societe $societe, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('societe_deletion_' . $societe->getId(), $request->request->get('csrf_token'))) {
            $em->remove($societe);
            $em->flush();

            $this->addFlash('info', 'Société supprimée avec succès !');
        }

        return $this->redirectToRoute('app_societes');
    }
    
}
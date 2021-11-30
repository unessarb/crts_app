<?php

namespace App\Controller;

use App\Entity\Depense;
use App\Form\DepenseType;
use App\Repository\DepenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepenseController extends AbstractController
{
    #[Route('/depenses', name: 'app_depenses')]
    public function index(DepenseRepository $depenseRepository): Response
    {
        $depenses = $depenseRepository->findAll();
        return $this->render('depenses/index.html.twig', [
            'depenses' => $depenses,
        ]);
    }

    #[Route('/depenses/new', name: 'app_new_depense', methods: ["GET", "POST"])]
    #[IsGranted("ROLE_REGIE")]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $depense = new Depense;
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            try {
                $em->persist($depense);
                $em->flush();
                $this->addFlash('success', 'Depense ajoutée avec succès !');
                return $this->redirectToRoute('app_depenses');
                
            } catch (\Exception $ex) {
                return $this->render('depenses/new.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

           

        }
        return $this->render('depenses/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/depenses/{id<[0-9]+>}/edit', name: 'app_edit_depense', methods: ["GET", "POST"])]
    #[IsGranted("ROLE_REGIE")]
    public function edit(Request $request, EntityManagerInterface $em,Depense $depense): Response
    {
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            try {
                $em->flush();
                $this->addFlash('success', 'Depense modifiée avec succès !');
                return $this->redirectToRoute('app_depenses');
                
            } catch (\Exception $ex) {
                return $this->render('depenses/edit.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            
        }
        return $this->render('depenses/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/depenses/{id<[0-9]+>}/show', name: 'app_show_depense', methods: ["GET"])]
    public function show(Depense $depense): Response
    {
        return $this->render('depenses/show.html.twig', [
            'depense' => $depense,
        ]);
    }

    #[Route('/depenses/{id<[0-9]+>}', name: 'app_depense_delete', methods: ["POST"])]
    #[IsGranted("ROLE_REGIE")]
    public function delete(Request $request, Depense $depense, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('depense_deletion_' . $depense->getId(), $request->request->get('csrf_token'))) {

            $em->remove($depense);
           
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_depenses');
    }

}
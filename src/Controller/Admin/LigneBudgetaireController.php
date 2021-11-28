<?php

namespace App\Controller\Admin;

use App\Entity\LigneBudgetaire;
use App\Form\LigneBudgetaireType;
use App\Repository\LigneBudgetaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class LigneBudgetaireController extends AbstractController
{
    #[Route('/ligne_budgetaires', name: 'app_ligne_budgetaire')]
    public function index(LigneBudgetaireRepository $ligneBudgetaireRepository): Response
    {
        $ligne_budgetaires = $ligneBudgetaireRepository->findAll();
        return $this->render('admin/ligne_budgetaire/index.html.twig', [
            'ligne_budgetaires' => $ligne_budgetaires,
        ]);
    }

    #[Route('/ligne_budgetaires/new', name: 'app_new_ligne_budgetaire', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $ligne_budgetaire = new LigneBudgetaire;
        $form = $this->createForm(LigneBudgetaireType::class, $ligne_budgetaire);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->persist($ligne_budgetaire);
            $em->flush();

            $this->addFlash('success', 'Ajouté avec succès !');

            return $this->redirectToRoute('app_ligne_budgetaire');
        }
        return $this->render('admin/ligne_budgetaire/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ligne_budgetaires/edit/{id<[0-9]+>}', name: 'app_edit_ligne_budgetaire', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,LigneBudgetaire $ligne_budgetaire): Response
    {
        $form = $this->createForm(LigneBudgetaireType::class, $ligne_budgetaire);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Modifié avec succès !');
            return $this->redirectToRoute('app_ligne_budgetaire');
            
        }
        return $this->render('admin/ligne_budgetaire/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ligne_budgetaires/{id<[0-9]+>}', name: 'app_ligne_budgetaire_delete', methods: ["POST"])]
    public function delete(Request $request, LigneBudgetaire $ligne_budgetaire, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('ligne_budgetaire_deletion_' . $ligne_budgetaire->getId(), $request->request->get('csrf_token'))) {
            $em->remove($ligne_budgetaire);
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_ligne_budgetaire');
    }
}
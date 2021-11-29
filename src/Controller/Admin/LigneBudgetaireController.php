<?php

namespace App\Controller\Admin;

use App\Entity\LigneBudgetaire;
use App\Form\LigneBudgetaireType;
use App\Repository\LigneBudgetaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class LigneBudgetaireController extends AbstractController
{

    #[Route('/ligne/type/{type}', name: 'ligne_budgetaire_type', methods: ['GET'])]
    public function getLigneFromType($type,LigneBudgetaireRepository $ligneBudgetaireRepository): Response
    {
        
        $lignes = $ligneBudgetaireRepository->findBy(['fontionnementInvestissement' => $type]);

        $response = array();
    foreach ($lignes as $ligne) {
        $response[] = array(
            'ligne_id' => $ligne->getId(),
            'ligne_rubrique' => $ligne->getRubrique()
        );
    }
        return new JsonResponse(($response));

    }


    #[Route('/ligne', name: 'ligne_budgetaire_index', methods: ['GET'])]
    public function index(LigneBudgetaireRepository $ligneBudgetaireRepository): Response
    {
        return $this->render('ligne_budgetaire/index.html.twig', [
            'ligne_budgetaires' => $ligneBudgetaireRepository->findAll(),
        ]);
    }

    #[Route('/ligne/new', name: 'ligne_budgetaire_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $ligneBudgetaire = new LigneBudgetaire();
        $form = $this->createForm(LigneBudgetaireType::class, $ligneBudgetaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ligneBudgetaire);
            $entityManager->flush();

            return $this->redirectToRoute('ligne_budgetaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne_budgetaire/new.html.twig', [
            'ligne_budgetaire' => $ligneBudgetaire,
            'form' => $form,
        ]);
    }

    #[Route('/ligne/sow/{id<[0-9]+>}', name: 'ligne_budgetaire_show', methods: ['GET'])]
    public function show(LigneBudgetaire $ligneBudgetaire): Response
    {
        return $this->render('ligne_budgetaire/show.html.twig', [
            'ligne_budgetaire' => $ligneBudgetaire,
        ]);
    }

    #[Route('/ligne/edit/{id<[0-9]+>}', name: 'ligne_budgetaire_edit', methods: ['GET','POST'])]
    public function edit(Request $request, LigneBudgetaire $ligneBudgetaire): Response
    {
        $form = $this->createForm(LigneBudgetaireType::class, $ligneBudgetaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ligne_budgetaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne_budgetaire/edit.html.twig', [
            'ligne_budgetaire' => $ligneBudgetaire,
            'form' => $form,
        ]);
    }

    #[Route('/ligne/{id<[0-9]+>}', name: 'ligne_budgetaire_delete', methods: ['POST'])]
    public function delete(Request $request, LigneBudgetaire $ligneBudgetaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligneBudgetaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ligneBudgetaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ligne_budgetaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
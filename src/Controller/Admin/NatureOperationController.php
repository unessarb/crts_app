<?php

namespace App\Controller\Admin;

use App\Entity\NatureRecette;
use App\Entity\NatureOperationBonCommande;
use App\Entity\NatureOperationContrat;
use App\Entity\NatureOperationDepense;
use App\Entity\NatureOperationMarcheReconductible;
use App\Entity\NatureOperationMarcheUnique;
use App\Form\NatureOperRecetteType;
use App\Form\NatureNatureOperMarcheReconductibleType;
use App\Form\NatureOperBonCommandeType;
use App\Form\NatureOperContactType;
use App\Form\NatureOperDepenseType;
use App\Form\NatureOperMarcheUniqueType;
use App\Repository\NatureRecetteRepository;
use App\Repository\NatureOperationBonCommandeRepository;
use App\Repository\NatureOperationContratRepository;
use App\Repository\NatureOperationDepenseRepository;
use App\Repository\NatureOperationMarcheReconductibleRepository;
use App\Repository\NatureOperationMarcheUniqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_AGENT')")
 */
class NatureOperationController extends AbstractController
{
    /**
     * ======================================
     * NATURE OPERATION MARCHE UNIQUE / CADRE
     * ======================================
     */


    #[Route('/natureUC/type/{type}', name: 'natureUC_type', methods: ['GET'])]
    public function getNatureCFromTitulire($type,NatureOperationMarcheUniqueRepository $natureOperation): Response
    {
        
        $lignes = $natureOperation->findBy(['tfs' => $type]);

        $response = array();
    foreach ($lignes as $ligne) {
        $response[] = array(
            'nature_id' => $ligne->getId(),
            'nature_rubrique' => $ligne->getNatureOperation()
        );
    }
        return new JsonResponse(($response));

    }


    #[Route('/natureR/type/{type}', name: 'natureR_type', methods: ['GET'])]
    public function getNatureRFromTitulire($type,NatureOperationMarcheReconductibleRepository $natureOperation): Response
    {
        
        $lignes = $natureOperation->findBy(['tfs' => $type]);

        $response = array();
    foreach ($lignes as $ligne) {
        $response[] = array(
            'nature_id' => $ligne->getId(),
            'nature_rubrique' => $ligne->getNatureOperation()
        );
    }
        return new JsonResponse(($response));

    }


    #[Route('/nature-operation-marche-unique', name: 'app_nature_operation_marche_unique')]
    public function index_marche_unique(NatureOperationMarcheUniqueRepository $natureOperation): Response
    {
        $marches = $natureOperation->findAll();
        return $this->render('admin/nature_operation/marche_unique/index.html.twig', [
            'marches' => $marches,
        ]);
    }

    #[Route('/nature-operation-marche-unique/new', name: 'app_new_nature_operation_marche_unique', methods: ["GET", "POST"])]
    public function new_marche_unique(Request $request, EntityManagerInterface $em): Response
    {
        $marche = new NatureOperationMarcheUnique;
        $form = $this->createForm(NatureOperMarcheUniqueType::class, $marche);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($marche);
            $em->flush();

            $this->addFlash('success', 'Nature opération pour marchés Unique / Cadre ajoutée avec succès !');

            return $this->redirectToRoute('app_nature_operation_marche_unique');
        }
        return $this->render('admin/nature_operation/marche_unique/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-marche-unique/edit/{id<[0-9]+>}', name: 'app_edit_nature_operation_marche_unique', methods: ["GET", "POST"])]
    public function edit_marche_unique(Request $request, EntityManagerInterface $em, NatureOperationMarcheUnique $marche): Response
    {
        $form = $this->createForm(NatureOperMarcheUniqueType::class, $marche);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Nature opération pour marchés Unique / Cadre modifiée avec succès !');
            return $this->redirectToRoute('app_nature_operation_marche_unique');
            
        }
        return $this->render('admin/nature_operation/marche_unique/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-marche-unique/{id<[0-9]+>}', name: 'app_delete_nature_operation_marche_unique', methods: ["POST"])]
    public function delete_marche_unique(Request $request, NatureOperationMarcheUnique $marche, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('marche_unique_deletion_' . $marche->getId(), $request->request->get('csrf_token'))) {
            $em->remove($marche);
            $em->flush();

            $this->addFlash('info', 'Nature opération pour marchés Unique / Cadre supprimée avec succès !');
        }

        return $this->redirectToRoute('app_nature_operation_marche_unique');
    }

    /**
     * ======================================
     * NATURE OPERATION MARCHE RECONDUCTIBLE
     * ======================================
     */

    #[Route('/nature-operation-marche-reconductible', name: 'app_nature_operation_marche_reconductible')]
    public function index_marche_reconductible(NatureOperationMarcheReconductibleRepository $natureOperation): Response
    {
        $marches = $natureOperation->findAll();
        return $this->render('admin/nature_operation/marche_reconductible/index.html.twig', [
            'marches' => $marches,
        ]);
    }

    #[Route('/nature-operation-marche-reconductible/new', name: 'app_new_nature_operation_marche_reconductible', methods: ["GET", "POST"])]
    public function new_marche_reconductible(Request $request, EntityManagerInterface $em): Response
    {
        $marche = new NatureOperationMarcheReconductible;
        $form = $this->createForm(NatureNatureOperMarcheReconductibleType::class, $marche);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($marche);
            $em->flush();

            $this->addFlash('success', 'Nature opération pour marchés Reconductible ajoutée avec succès !');

            return $this->redirectToRoute('app_nature_operation_marche_reconductible');
        }
        return $this->render('admin/nature_operation/marche_reconductible/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-marche-reconductible/edit/{id<[0-9]+>}', name: 'app_edit_nature_operation_marche_reconductible', methods: ["GET", "POST"])]
    public function edit_marche_reconductible(Request $request, EntityManagerInterface $em, NatureOperationMarcheReconductible $marche): Response
    {
        $form = $this->createForm(NatureNatureOperMarcheReconductibleType::class, $marche);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Nature opération pour marchés Reconductible modifiée avec succès !');
            return $this->redirectToRoute('app_nature_operation_marche_reconductible');
            
        }
        return $this->render('admin/nature_operation/marche_reconductible/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-marche-reconductible/{id<[0-9]+>}', name: 'app_delete_nature_operation_marche_reconductible', methods: ["POST"])]
    public function delete_marche_reconductible(Request $request, NatureOperationMarcheReconductible $marche, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('marche_reconductible_deletion_' . $marche->getId(), $request->request->get('csrf_token'))) {
            $em->remove($marche);
            $em->flush();

            $this->addFlash('info', 'Nature opération pour marchés Reconductible supprimée avec succès !');
        }

        return $this->redirectToRoute('app_nature_operation_marche_reconductible');
    }

    /**
     * ======================================
     * NATURE OPERATION CONTRAT
     * ======================================
     */






    #[Route('/nature-operation-contrat', name: 'app_nature_operation_contrat')]
    public function index_contrat(NatureOperationContratRepository $natureOperation): Response
    {
        $operations = $natureOperation->findAll();
        return $this->render('admin/nature_operation/contrat/index.html.twig', [
            'operations' => $operations,
        ]);
    }

    #[Route('/nature-operation-contrat/new', name: 'app_new_nature_operation_contrat', methods: ["GET", "POST"])]
    public function new_contrat(Request $request, EntityManagerInterface $em): Response
    {
        $operation = new NatureOperationContrat;
        $form = $this->createForm(NatureOperContactType::class, $operation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($operation);
            $em->flush();

            $this->addFlash('success', 'Nature opération contrat ajoutée avec succès !');

            return $this->redirectToRoute('app_nature_operation_contrat');
        }
        return $this->render('admin/nature_operation/contrat/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-contrat/edit/{id<[0-9]+>}', name: 'app_edit_nature_operation_contrat', methods: ["GET", "POST"])]
    public function edit_contrat(Request $request, EntityManagerInterface $em, NatureOperationContrat $operation): Response
    {
        $form = $this->createForm(NatureOperContactType::class, $operation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Nature opération contrat modifiée avec succès !');
            return $this->redirectToRoute('app_nature_operation_contrat');
            
        }
        return $this->render('admin/nature_operation/contrat/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-contrat/{id<[0-9]+>}', name: 'app_delete_nature_operation_contrat', methods: ["POST"])]
    public function delete_contrat(Request $request, NatureOperationContrat $operation, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('contrat_deletion_' . $operation->getId(), $request->request->get('csrf_token'))) {
            $em->remove($operation);
            $em->flush();

            $this->addFlash('info', 'Nature opération contrat supprimée avec succès !');
        }

        return $this->redirectToRoute('app_nature_operation_contrat');
    }

    /**
     * ======================================
     * NATURE OPERATION BON COMMANDE
     * ======================================
     */


    #[Route('/natureBC/type/{type}', name: 'natureBC_type', methods: ['GET'])]
    public function getSocieteFromTitulire($type,NatureOperationBonCommandeRepository $natureOperation): Response
    {
        
        $lignes = $natureOperation->findBy(['tfs' => $type]);

        $response = array();
    foreach ($lignes as $ligne) {
        $response[] = array(
            'nature_id' => $ligne->getId(),
            'nature_rubrique' => $ligne->getNatureOperation()
        );
    }
        return new JsonResponse(($response));

    }




    #[Route('/nature-operation-bon-commande', name: 'app_nature_operation_bon_commande')]
    public function index_bon_commande(NatureOperationBonCommandeRepository $natureOperation): Response
    {
        $operations = $natureOperation->findAll();
        return $this->render('admin/nature_operation/bon_commande/index.html.twig', [
            'operations' => $operations,
        ]);
    }

    #[Route('/nature-operation-bon-commande/new', name: 'app_new_nature_operation_bon_commande', methods: ["GET", "POST"])]
    public function new_bon_commande(Request $request, EntityManagerInterface $em): Response
    {
        $operation = new NatureOperationBonCommande;
        $form = $this->createForm(NatureOperBonCommandeType::class, $operation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($operation);
            $em->flush();

            $this->addFlash('success', 'Nature opération bon commande ajoutée avec succès !');

            return $this->redirectToRoute('app_nature_operation_bon_commande');
        }
        return $this->render('admin/nature_operation/bon_commande/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-bon-commande/edit/{id<[0-9]+>}', name: 'app_edit_nature_operation_bon_commande', methods: ["GET", "POST"])]
    public function edit_bon_commande(Request $request, EntityManagerInterface $em, NatureOperationBonCommande $operation): Response
    {
        $form = $this->createForm(NatureOperBonCommandeType::class, $operation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Nature opération bon commande modifiée avec succès !');
            return $this->redirectToRoute('app_nature_operation_bon_commande');
            
        }
        return $this->render('admin/nature_operation/bon_commande/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-bon-commande/{id<[0-9]+>}', name: 'app_delete_nature_operation_bon_commande', methods: ["POST"])]
    public function delete_bon_commande(Request $request, NatureOperationBonCommande $operation, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('bon_commande_deletion_' . $operation->getId(), $request->request->get('csrf_token'))) {
            $em->remove($operation);
            $em->flush();

            $this->addFlash('info', 'Nature opération bon commande supprimée avec succès !');
        }

        return $this->redirectToRoute('app_nature_operation_bon_commande');
    }







    /**
     * ======================================
     * NATURE OPERATION Recette
     * ======================================
     */
/*
    #[Route('/nature-operation-recette', name: 'app_nature_operation_recette')]
    public function index_recette(NatureRecetteRepository $natureOperation): Response
    {
        $operations = $natureOperation->findBy([], ["id"=>"desc"]);
        return $this->render('admin/nature_operation/recette/index.html.twig', [
            'operations' => $operations,
        ]);
    }

    #[Route('/nature-operation-recette/new', name: 'app_new_nature_operation_recette', methods: ["GET", "POST"])]
    public function new_recette(Request $request, EntityManagerInterface $em): Response
    {
        $operation = new NatureRecette;
        $form = $this->createForm(NatureOperRecetteType::class, $operation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($operation);
            $em->flush();

            $this->addFlash('success', 'Nature opération recette ajoutée avec succès !');

            return $this->redirectToRoute('app_nature_operation_recette');
        }
        return $this->render('admin/nature_operation/recette/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-recette/edit/{id<[0-9]+>}', name: 'app_edit_nature_operation_recette', methods: ["GET", "POST"])]
    public function edit_recette(Request $request, EntityManagerInterface $em, NatureOperationBonCommande $operation): Response
    {
        $form = $this->createForm(NatureRecetteType::class, $operation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Nature opération recette modifiée avec succès !');
            return $this->redirectToRoute('app_nature_operation_recette');
            
        }
        return $this->render('admin/nature_operation/recette/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nature-operation-recette/{id<[0-9]+>}', name: 'app_delete_nature_operation_recette', methods: ["POST"])]
    public function delete_recette(Request $request, NatureRecette $operation, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('recette_deletion_' . $operation->getId(), $request->request->get('csrf_token'))) {
            $em->remove($operation);
            $em->flush();

            $this->addFlash('info', 'Nature opération recette supprimée avec succès !');
        }

        return $this->redirectToRoute('app_nature_operation_recette');
    }

*/

}
<?php

namespace App\Controller;

use App\Entity\MarcheUnique;
use App\Entity\Societe;
use App\Form\MarcheUniqueType;
use App\Form\SocieteType;
use App\Repository\MarcheUniqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarcheUniqueController extends AbstractController
{
    #[Route('/marches', name: 'app_marches')]
    public function index(MarcheUniqueRepository $marcheUniqueRepository): Response
    {
        $marches = $marcheUniqueRepository->findBy([], ["createdAt"=>"desc"]);
        return $this->render('marche_unique/index.html.twig', [
            'marches' => $marches,
        ]);
    }

    #[Route('/marches/new', name: 'app_new_marches', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $marche = new MarcheUnique;
        $societe = new Societe;
        $form = $this->createForm(MarcheUniqueType::class, $marche);
        $form2 = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->persist($marche);
            $em->flush();

            $this->addFlash('success', 'Marché ajouté avec succès !');

            return $this->redirectToRoute('app_marches');
        }
        return $this->render('marche_unique/new.html.twig', [
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }

    #[Route('/marches/edit/{id<[0-9]+>}', name: 'app_edit_marches', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,MarcheUnique $marche): Response
    {
        $form = $this->createForm(MarcheUniqueType::class, $marche);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Modifié avec succès !');
            return $this->redirectToRoute('app_marches');
            
        }
        return $this->render('marche_unique/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/marches/{id<[0-9]+>}', name: 'app_marches_delete', methods: ["POST"])]
    public function delete(Request $request, MarcheUnique $marche, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('marche_deletion_' . $marche->getId(), $request->request->get('csrf_token'))) {
            $em->remove($marche);
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_marches');
    }
}
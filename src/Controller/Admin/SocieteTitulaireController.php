<?php

namespace App\Controller\Admin;

use App\Entity\SocieteTitulaire;
use App\Form\TitulaireType;
use App\Repository\SocieteTitulaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocieteTitulaireController extends AbstractController
{
    #[Route('/titulaires', name: 'app_titulaires')]
    public function index(SocieteTitulaireRepository $societeTitulaireRepository): Response
    {
        $titulaires = $societeTitulaireRepository->findBy([], ["createdAt"=>"desc"]);
        return $this->render('admin/titulaire/index.html.twig', [
            'titulaires' => $titulaires,
        ]);
    }

    #[Route('/titulaires/new', name: 'app_new_titulaires', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $titulaire = new SocieteTitulaire;
        $form = $this->createForm(TitulaireType::class, $titulaire);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->persist($titulaire);
            $em->flush();

            $this->addFlash('success', 'Ajouté avec succès !');

            return $this->redirectToRoute('app_titulaires');
        }
        return $this->render('admin/titulaire/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/titulaires/edit/{id<[0-9]+>}', name: 'app_edit_titulaires', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,SocieteTitulaire $titulaire): Response
    {
        $form = $this->createForm(TitulaireType::class, $titulaire);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Modifié avec succès !');
            return $this->redirectToRoute('app_titulaires');
            
        }
        return $this->render('admin/titulaire/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/titulaires/{id<[0-9]+>}', name: 'app_titulaires_delete', methods: ["POST"])]
    public function delete(Request $request, SocieteTitulaire $titulaire, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('titulaire_deletion_' . $titulaire->getId(), $request->request->get('csrf_token'))) {
            $em->remove($titulaire);
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_titulaires');
    }
}
<?php

namespace App\Controller\Admin;

use App\Entity\Devise;
use App\Form\DeviseType;
use App\Repository\DeviseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_AGENT')")
 */
class DeviseController extends AbstractController
{
    #[Route('/devises', name: 'app_devises')]
    public function index(DeviseRepository $deviseRepository): Response
    {
        $devises = $deviseRepository->findAll();
        return $this->render('admin/devise/index.html.twig', [
            'devises' => $devises,
        ]);
    }

    #[Route('/devises/new', name: 'app_new_devises', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $devise = new Devise;
        $form = $this->createForm(DeviseType::class, $devise);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->persist($devise);
            $em->flush();

            $this->addFlash('success', 'Ajouté avec succès !');

            return $this->redirectToRoute('app_devises');
        }
        return $this->render('admin/devise/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/devises/edit/{id<[0-9]+>}', name: 'app_edit_devises', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,Devise $devise): Response
    {
        $form = $this->createForm(DeviseType::class, $devise);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Modifié avec succès !');
            return $this->redirectToRoute('app_devises');
            
        }
        return $this->render('admin/devise/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/devises/{id<[0-9]+>}', name: 'app_devises_delete', methods: ["POST"])]
    public function delete(Request $request, Devise $devise, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('devise_deletion_' . $devise->getId(), $request->request->get('csrf_token'))) {
            $em->remove($devise);
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_devises');
    }
}
<?php

namespace App\Controller;

use App\Entity\Personnel;
use App\Form\PersonnelType;
use App\Repository\PersonnelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_REGIE")
 */
class PersonnelController extends AbstractController
{
    #[Route('/personnels', name: 'app_personnels')]
    public function index(PersonnelRepository $personnelRepository): Response
    {
        $personnels = $personnelRepository->findAll();
        return $this->render('personnel/index.html.twig', [
            'personnels' => $personnels,
        ]);
    }

    #[Route('/personnels/new', name: 'app_new_personnels', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $personnel = new Personnel;
        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->persist($personnel);
            $em->flush();

            $this->addFlash('success', 'Société ajoutée avec succès !');

            return $this->redirectToRoute('app_personnels');
        }
        return $this->render('personnel/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/personnels/edit/{id<[0-9]+>}', name: 'app_edit_personnels', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,Personnel $personnel): Response
    {
        $form = $this->createForm(PersonnelType::class, $personnel);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Société modifiée avec succès !');
            return $this->redirectToRoute('app_personnels');
            
        }
        return $this->render('personnel/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/personnels/{id<[0-9]+>}', name: 'app_personnels_delete', methods: ["POST"])]
    public function delete(Request $request, Personnel $personnel, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('personnel_deletion_' . $personnel->getId(), $request->request->get('csrf_token'))) {
            $em->remove($personnel);
            $em->flush();

            $this->addFlash('info', 'Société supprimée avec succès !');
        }

        return $this->redirectToRoute('app_personnels');
    }
    
}
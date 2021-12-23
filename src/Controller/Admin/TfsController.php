<?php

namespace App\Controller\Admin;

use App\Entity\Tfs;
use App\Form\TfsType;
use App\Repository\TfsRepository;
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
class TfsController extends AbstractController
{
    #[Route('/tfs', name: 'app_tfs')]
    public function index(TfsRepository $tfsRepository): Response
    {
        $tfs = $tfsRepository->findAll();
        return $this->render('admin/tfs/index.html.twig', [
            'tfs' => $tfs,
        ]);
    }

    #[Route('/tfs/new', name: 'app_new_tfs', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $tfs = new Tfs;
        $form = $this->createForm(TfsType::class, $tfs);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $tfs->setCode(substr($tfs->getName(), 0, 1));
            $em->persist($tfs);
            $em->flush();

            $this->addFlash('success', 'Ajouté avec succès !');

            return $this->redirectToRoute('app_tfs');
        }
        return $this->render('admin/tfs/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tfs/edit/{id<[0-9]+>}', name: 'app_edit_tfs', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,Tfs $tfs): Response
    {
        $form = $this->createForm(TfsType::class, $tfs);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            
            $tfs->setCode(substr($tfs->getName(), 0, 1));
            $em->flush();
            $this->addFlash('success', 'Modifié avec succès !');
            return $this->redirectToRoute('app_tfs');
            
        }
        return $this->render('admin/tfs/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tfs/{id<[0-9]+>}', name: 'app_tfs_delete', methods: ["POST"])]
    public function delete(Request $request, Tfs $tfs, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('tfs_deletion_' . $tfs->getId(), $request->request->get('csrf_token'))) {
            $em->remove($tfs);
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_tfs');
    }
}
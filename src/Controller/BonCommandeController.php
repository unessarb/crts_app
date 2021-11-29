<?php

namespace App\Controller;

use App\Entity\BonCommande;
use App\Entity\Societe;
use App\Form\BonCommandesType;
use App\Form\SocieteType;
use App\Repository\BonCommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BonCommandeController extends AbstractController
{
    #[Route('/bon_commandes', name: 'app_bon_commandes')]
    public function index(BonCommandeRepository $bonCommandeRepository): Response
    {
        $bon_commandes = $bonCommandeRepository->findAll();
        return $this->render('bon_commandes/index.html.twig', [
            'bon_commandes' => $bon_commandes,
        ]);
    }

    #[Route('/bon_commandes/new', name: 'app_new_bon_commande', methods: ["GET", "POST"])]
    #[IsGranted("ROLE_AGENT")]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $bnCommande = new BonCommande;
        $societe = new Societe;
        $form = $this->createForm(BonCommandesType::class, $bnCommande);
        $form2 = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            try {
                $generator = new BarcodeGeneratorJPG();
            
                if (!is_dir('uploads/barcode')) {
                    // dir doesn't exist, make it
                    mkdir('uploads/barcode', 0777, true);
                }

                $code_bar = $this->generateCodeBare($bnCommande);

                $fileName= str_replace(' ','', $code_bar).'.jpg';
                file_put_contents('uploads/barcode/'.$fileName, $generator->getBarcode($code_bar, $generator::TYPE_CODE_39, 3, 50));
                
                $bnCommande->setCodeDoc($code_bar);
                $bnCommande->setCodeBarImg($fileName);
                $em->persist($bnCommande);
                $em->flush();
                $this->addFlash('success', 'Bon de commande ajouté avec succès !');
                return $this->redirectToRoute('app_bon_commandes');
                
            } catch (\Exception $ex) {
                return $this->render('bon_commandes/new.html.twig', [
                    'form' => $form->createView(),
                    'form2' => $form2->createView(),
                ]);
            }

           

        }
        return $this->render('bon_commandes/new.html.twig', [
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }

    #[Route('/bon_commandes/{id<[0-9]+>}/edit', name: 'app_edit_bon_commande', methods: ["GET", "POST"])]
    #[IsGranted("ROLE_AGENT")]
    public function edit(Request $request, EntityManagerInterface $em,BonCommande $bon_commande): Response
    {
        $form = $this->createForm(BonCommandesType::class, $bon_commande);
        $societe = new Societe;
        $form2 = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            try {
                $generator = new BarcodeGeneratorJPG();
            
                if (!is_dir('uploads/barcode')) {
                    // dir doesn't exist, make it
                    mkdir('uploads/barcode', 0777, true);
                }
                
                if(is_file('uploads/barcode/'.$bon_commande->getCodeBarImg())){
                    unlink('uploads/barcode/'.$bon_commande->getCodeBarImg());
                }

                $code_bar = $this->generateCodeBare($bon_commande);

                $fileName= str_replace(' ','', $code_bar).'.jpg';
                file_put_contents('uploads/barcode/'.$fileName, $generator->getBarcode($code_bar, $generator::TYPE_CODE_39));
                
                $bon_commande->setCodeDoc($code_bar);
                $bon_commande->setCodeBarImg($fileName);
                $em->flush();
                $this->addFlash('success', 'Bon de commande modifié avec succès !');
                return $this->redirectToRoute('app_bon_commandes');
                
            } catch (\Exception $ex) {
                return $this->render('bon_commandes/edit.html.twig', [
                    'form' => $form->createView(),
                    'form2' => $form2->createView(),
                ]);
            }

            
        }
        return $this->render('bon_commandes/edit.html.twig', [
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }


    #[Route('/bon_commandes/{id<[0-9]+>}/show', name: 'app_show_bon_commande', methods: ["GET"])]
    public function show(BonCommande $bon_commande): Response
    {
        return $this->render('bon_commandes/show.html.twig', [
            'bon_commande' => $bon_commande,
        ]);
    }

    #[Route('/bon_commandes/{id<[0-9]+>}', name: 'app_bon_commande_delete', methods: ["POST"])]
    #[IsGranted("ROLE_AGENT")]
    public function delete(Request $request, BonCommande $bon_commande, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('bon_commande_deletion_' . $bon_commande->getId(), $request->request->get('csrf_token'))) {

            $em->remove($bon_commande);

            if(is_file('uploads/barcode/'.$bon_commande->getCodeBarImg())){
                unlink('uploads/barcode/'.$bon_commande->getCodeBarImg());
            }
            
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_bon_commandes');
    }

    private function generateCodeBare(BonCommande $bon_commande){

        return  $bon_commande->getNumBc(). ' ' . 
                $bon_commande->getTfs()->getCode() . ' 2' . 
                $bon_commande->getTypeBc() . 
                $bon_commande->getTitulaire()->getId().' '.
                $bon_commande->getNatureOperation()->getCode().' '.
                $bon_commande->getLineBudgetaire()->getNum().' '.
                $bon_commande->getFontionnementInvestissement().' '.
                $bon_commande->getAnneeBudgetaire();
    }
}
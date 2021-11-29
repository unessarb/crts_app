<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Entity\Societe;
use App\Form\ContratType;
use App\Form\SocieteType;
use App\Repository\ContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContratController extends AbstractController
{
    #[Route('/contrats', name: 'app_contrats')]
    public function index(ContratRepository $contratRepository): Response
    {
        $contrats = $contratRepository->findAll();
        return $this->render('contrats/index.html.twig', [
            'contrats' => $contrats,
        ]);
    }

    #[Route('/contrats/new', name: 'app_new_contrat', methods: ["GET", "POST"])]
    #[IsGranted("ROLE_AGENT")]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $contrat = new Contrat;
        $societe = new Societe;
        $form = $this->createForm(ContratType::class, $contrat);
        $form2 = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            try {
                $generator = new BarcodeGeneratorJPG();
            
                if (!is_dir('uploads/barcode')) {
                    // dir doesn't exist, make it
                    mkdir('uploads/barcode', 0777, true);
                }

                $code_bar = $this->generateCodeBare($contrat);

                $fileName= str_replace(' ','', $code_bar).'.jpg';
                file_put_contents('uploads/barcode/'.$fileName, $generator->getBarcode($code_bar, $generator::TYPE_CODE_39, 3, 50));
                
                $contrat->setCodeDoc($code_bar);
                $contrat->setCodeBarImg($fileName);
                $em->persist($contrat);
                $em->flush();
                $this->addFlash('success', 'Contrat ajoutée avec succès !');
                return $this->redirectToRoute('app_contrats');
                
            } catch (\Exception $ex) {
                return $this->render('contrats/new.html.twig', [
                    'form' => $form->createView(),
                    'form2' => $form2->createView(),
                ]);
            }

           

        }
        return $this->render('contrats/new.html.twig', [
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }

    #[Route('/contrats/{id<[0-9]+>}/edit', name: 'app_edit_contrat', methods: ["GET", "POST"])]
    #[IsGranted("ROLE_AGENT")]
    public function edit(Request $request, EntityManagerInterface $em,Contrat $contrat): Response
    {
        $form = $this->createForm(ContratType::class, $contrat);
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
                
                if(is_file('uploads/barcode/'.$contrat->getCodeBarImg())){
                    unlink('uploads/barcode/'.$contrat->getCodeBarImg());
                }

                $code_bar = $this->generateCodeBare($contrat);

                $fileName= str_replace(' ','', $code_bar).'.jpg';
                file_put_contents('uploads/barcode/'.$fileName, $generator->getBarcode($code_bar, $generator::TYPE_CODE_39));
                
                $contrat->setCodeDoc($code_bar);
                $contrat->setCodeBarImg($fileName);
                $em->flush();
                $this->addFlash('success', 'Contrat modifiée avec succès !');
                return $this->redirectToRoute('app_contrats');
                
            } catch (\Exception $ex) {
                return $this->render('contrats/edit.html.twig', [
                    'form' => $form->createView(),
                    'form2' => $form2->createView(),
                ]);
            }

            
        }
        return $this->render('contrats/edit.html.twig', [
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }


    #[Route('/contrats/{id<[0-9]+>}/show', name: 'app_show_contrat', methods: ["GET"])]
    public function show(Contrat $contrat): Response
    {
        return $this->render('contrats/show.html.twig', [
            'contrat' => $contrat,
        ]);
    }

    #[Route('/contrats/{id<[0-9]+>}', name: 'app_contrat_delete', methods: ["POST"])]
    #[IsGranted("ROLE_AGENT")]
    public function delete(Request $request, Contrat $contrat, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('contrat_deletion_' . $contrat->getId(), $request->request->get('csrf_token'))) {

            $em->remove($contrat);

            if(is_file('uploads/barcode/'.$contrat->getCodeBarImg())){
                unlink('uploads/barcode/'.$contrat->getCodeBarImg());
            }
            
            $em->flush();

            $this->addFlash('info', 'Supprimé avec succès !');
        }

        return $this->redirectToRoute('app_contrats');
    }

    private function generateCodeBare(Contrat $contrat){

        return  $contrat->getNumCC(). ' 3' . 
                $contrat->getTypeContrat() . 
                $contrat->getTitulaire()->getId().' '.
                $contrat->getNatureOperation()->getCode().' '.
                $contrat->getLineBudgetaire()->getNum().' '.
                $contrat->getFontionnementInvestissement().' '.
                $contrat->getAnneeBudgetaire();
    }
}
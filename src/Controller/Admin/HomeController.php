<?php

namespace App\Controller\Admin;

use App\Repository\BonCommandeRepository;
use App\Repository\ContratRepository;
use App\Repository\MarcheUniqueRepository;
use App\Repository\SocieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods="GET")
     */
    public function index(MarcheUniqueRepository $marcheUniqueRepository, ContratRepository $contratRepository, BonCommandeRepository $bonCommandeRepository, SocieteRepository $societeRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $countMarche = $marcheUniqueRepository->count([]);
        $countContrat = $contratRepository->count([]);
        $countBonCmd = $bonCommandeRepository->count([]);
        $countSociete = $societeRepository->count([]);


        $marches = $marcheUniqueRepository->findBy(['anneeBudgetaire' => '2021']);
        $contrats= $contratRepository->findBy(['anneeBudgetaire' => '2021']);
        $bons= $bonCommandeRepository->findBy(['anneeBudgetaire' => '2021']);


        $response = array();
        $response[]=count($marches);
        $response[]=count($contrats);
        $response[]=count($bons);
        
        return $this->render('admin/home/index.html.twig', compact('countMarche', 'countContrat', 'countBonCmd', 'countSociete','response'));

 
    
    
    }


    /**
     * @Route("/graphique/{annee}", name="app_home_graphique", methods="GET")
     */
    public function graphique($annee,MarcheUniqueRepository $marcheUniqueRepository, ContratRepository $contratRepository, BonCommandeRepository $bonCommandeRepository, SocieteRepository $societeRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $marches = $marcheUniqueRepository->findBy(['anneeBudgetaire' => $annee]);
        $contrats= $contratRepository->findBy(['anneeBudgetaire' => $annee]);
        $bons= $bonCommandeRepository->findBy(['anneeBudgetaire' => $annee]);


        $response = array();
        $response[]=count($marches);
        $response[]=count($contrats);
        $response[]=count($bons);

        return new JsonResponse(($response));
 
    }
}
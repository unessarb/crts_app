<?php

namespace App\Controller\Admin;

use App\Repository\BonCommandeRepository;
use App\Repository\ContratRepository;
use App\Repository\MarcheUniqueRepository;
use App\Repository\SocieteRepository;

use App\Repository\NatureOperationDepenseRepository;
use App\Repository\NatureRecetteRepository;
use App\Repository\RecetteRepository;
use App\Repository\DepenseRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods="GET")
     */
    public function index(MarcheUniqueRepository $marcheUniqueRepository, ContratRepository $contratRepository, BonCommandeRepository $bonCommandeRepository, SocieteRepository $societeRepository,DepenseRepository $depenseRepository,RecetteRepository $recetteRepository,NatureRecetteRepository $naturerecetteRepository,NatureOperationDepenseRepository $naturedepenseRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $countMarche = $marcheUniqueRepository->count([]);
        $countContrat = $contratRepository->count([]);
        $countBonCmd = $bonCommandeRepository->count([]);
        $countSociete = $societeRepository->count([]);

        $countNatureD = $naturedepenseRepository->count([]);
        $countNatureR = $naturerecetteRepository->count([]);
        $countR = $recetteRepository->count([]);
        $countD = $depenseRepository->count([]);

        $dateM=date("Y");
        $marches = $marcheUniqueRepository->findBy(['anneeBudgetaire' => $dateM]);
        $contrats= $contratRepository->findBy(['anneeBudgetaire' => $dateM]);
        $bons= $bonCommandeRepository->findBy(['anneeBudgetaire' => $dateM]);


        $response = array();
        $response[]=count($marches);
        $response[]=count($contrats);
        $response[]=count($bons);

      
        
        return $this->render('admin/home/index.html.twig', compact('countMarche', 'countContrat', 'countBonCmd', 'countSociete','response','countNatureR', 'countNatureD', 'countR', 'countD','dateM'));

 
    
    
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



    /**
     * @Route("/graphique2/{annee}", name="app_home_graphique2", methods="GET")
     */
    public function graphique2($annee,DepenseRepository $depenseRepository,RecetteRepository $recetteRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $depenses = $depenseRepository->findAll();
        $recettes= $recetteRepository->findAll();
       
$t=array(0,0,0,0,0,0,0,0,0,0,0,0);
$m=array(0,0,0,0,0,0,0,0,0,0,0,0);


foreach($depenses as $depense)
{
if("20".$depense->getCreatedAt()->format('y')==$annee)
{
    $t[intval($depense->getCreatedAt()->format('m'))-1]=$t[intval($depense->getCreatedAt()->format('m'))-1]+1;
    $m[intval($depense->getCreatedAt()->format('m'))-1]=$m[intval($depense->getCreatedAt()->format('m'))-1]+doubleval($depense->getMontant());
}

}

$t2=array(0,0,0,0,0,0,0,0,0,0,0,0);
$m2=array(0,0,0,0,0,0,0,0,0,0,0,0);

foreach($recettes as $recette)
{
if("20".$recette->getCreatedAt()->format('y')==$annee)
{
    $t2[intval($recette->getCreatedAt()->format('m'))-1]=$t2[intval($recette->getCreatedAt()->format('m'))-1]+1;
    $m2[intval($recette->getCreatedAt()->format('m'))-1]=$m2[intval($recette->getCreatedAt()->format('m'))-1]+doubleval($recette->getMontant());

}

}
        $response = array();
        $response[]=$t;
        $response[]=$t2;

        $response[]=$m;
        $response[]=$m2;
       // $response[]=count($recettes);
        

        return new JsonResponse(($response));
 
    }
}
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



        $depenses = $depenseRepository->findAll();
        $recettes= $recetteRepository->findAll();

        $montantRD=0.0;
        $montantRG=0.0;
        $ann=new \DateTime('now');
        $a=$ann->format('y');
        
        foreach($recettes as $recette)
        {
            //var_dump($recette);
            if($recette->getDateRecette())
            {

                //var_dump($recette->getTypeRecette());
            if($recette->getDateRecette()->format('y')==$a)
                {
                    
                    
                    if($recette->getTypeRecette()=="Recette Directe")
                    {
                        $montantRD=$montantRD+doubleval($recette->getMontant());
                        //var_dump(doubleval($recette->getMontant()));
                    }
                       
                    else
                        $montantRG=$montantRG+doubleval($recette->getMontant());

                }
            }

        }

        //var_dump($montantRD);
        $montantD=0;
        foreach($depenses as $depense)
        {
            if($depense->getDateDepense())
        if($depense->getDateDepense()->format('y')==$a)
        {
            $montantD=$montantD+doubleval($depense->getMontant());
        }
        
        }
      
        
        return $this->render('admin/home/index.html.twig', compact('montantD','montantRD','montantRG','countMarche', 'countContrat', 'countBonCmd', 'countSociete','response','countNatureR', 'countNatureD', 'countR', 'countD','dateM'));

 
    
    
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
    if($depense->getDateDepense())
if("20".$depense->getDateDepense()->format('y')==$annee)
{
    $t[intval($depense->getDateDepense()->format('m'))-1]=$t[intval($depense->getDateDepense()->format('m'))-1]+1;
    $m[intval($depense->getDateDepense()->format('m'))-1]=$m[intval($depense->getDateDepense()->format('m'))-1]+doubleval($depense->getMontant());
}

}

$t2=array(0,0,0,0,0,0,0,0,0,0,0,0);
$m2=array(0,0,0,0,0,0,0,0,0,0,0,0);

foreach($recettes as $recette)
{
    if($recette->getDateRecette())
if("20".$recette->getDateRecette()->format('y')==$annee)
{
    $t2[intval($recette->getDateRecette()->format('m'))-1]=$t2[intval($recette->getDateRecette()->format('m'))-1]+1;
    $m2[intval($recette->getDateRecette()->format('m'))-1]=$m2[intval($recette->getDateRecette()->format('m'))-1]+doubleval($recette->getMontant());

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
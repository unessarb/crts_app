<?php

namespace App\Controller\Admin;

use App\Repository\BonCommandeRepository;
use App\Repository\ContratRepository;
use App\Repository\MarcheUniqueRepository;
use App\Repository\SocieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        
        return $this->render('admin/home/index.html.twig', compact('countMarche', 'countContrat', 'countBonCmd', 'countSociete'));
    }
}
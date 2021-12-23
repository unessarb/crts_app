<?php

namespace App\Controller\Admin;

use App\Entity\Societe;
use App\Form\SocieteType;
use App\Repository\SocieteRepository;
use App\Repository\SocieteTitulaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_AGENT')")
 */
class SocieteController extends AbstractController
{
    #[Route('/societes', name: 'app_societes')]
    public function index(SocieteRepository $societeRepository): Response
    {
        $societes = $societeRepository->findAll();
        return $this->render('admin/societe/index.html.twig', [
            'societes' => $societes,
        ]);
    }

    #[Route('/societes/new', name: 'app_new_societes', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $societe = new Societe;
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->persist($societe);
            $em->flush();

            $this->addFlash('success', 'Société ajoutée avec succès !');

            return $this->redirectToRoute('app_societes');
        }
        return $this->render('admin/societe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/societes/edit/{id<[0-9]+>}', name: 'app_edit_societes', methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $em,Societe $societe): Response
    {
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash('success', 'Société modifiée avec succès !');
            return $this->redirectToRoute('app_societes');
            
        }
        return $this->render('admin/societe/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/societes/{id<[0-9]+>}', name: 'app_societes_delete', methods: ["POST"])]
    public function delete(Request $request, Societe $societe, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('societe_deletion_' . $societe->getId(), $request->request->get('csrf_token'))) {
            $em->remove($societe);
            $em->flush();

            $this->addFlash('info', 'Société supprimée avec succès !');
        }

        return $this->redirectToRoute('app_societes');
    }
    
    #[Route('/societes/new_ajax', name: 'app_new_ajax_societes', methods: ["GET", "POST"])]
    public function newAjax(
        Request $request, 
        EntityManagerInterface $em, 
        ValidatorInterface $validator,
        SocieteTitulaireRepository $societeTitulaireRepository
        ): JsonResponse
    {
        try {
            $data = $request->request->all();
            $societe = new Societe();
            $societe->setName($data['name']);
            $societe->setAdresse($data['adresse']);
            $societe->setCodeSociete( (int) $data['code_societe']);

            $titulaire = $societeTitulaireRepository->find($data['titulaire']);
            // return $this->json($titulaire->getId());
            $societe->setTitulaire($titulaire);
            $errors = $validator->validate($societe);
            if(count($errors) != 0){
                return $this->json($errors, JsonResponse::HTTP_BAD_REQUEST);
            }
            $em->persist($societe);
            $em->flush();
           
            return $this->json([
                "id"=> $societe->getId(),
                "name" => $societe->getName()
            ]);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        // try {
        //     $societe = $serializer->deserialize($request->getContent(), Societe::class, 'json');
        //     dd($societe);
        //     return $this->json($societe);

        //     $errors = $validator->validate($societe);
        //     if(count($errors) != 0){
        //         return $this->json($errors, JsonResponse::HTTP_BAD_REQUEST);
        //     }
        //     $em->persist($societe);
        //     $em->flush();
        //     return $this->json($societeRepository->findAll());
        // } catch (\Exception $e) {
        //     //throw $th;
        //     return $this->json($e->getTrace(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        // }
           
      
       
    }


    #[Route('/societe/type/{type}', name: 'societe_type', methods: ['GET'])]
    public function getSocieteFromTitulire($type,SocieteRepository $societeRepository): Response
    {
        
        $lignes = $societeRepository->findBy(['titulaire' => $type]);

        $response = array();
    foreach ($lignes as $ligne) {
        $response[] = array(
            'societe_id' => $ligne->getId(),
            'societe_rubrique' => $ligne->getName()
        );
    }
        return new JsonResponse(($response));

    }
}
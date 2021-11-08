<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AgentController extends AbstractController
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    
    #[Route('/admin/agents', name: 'app_agents')]
    public function index(UserRepository $userRepository): Response
    {
        $agents = $userRepository->createQueryBuilder('a')
        ->where('a.roles LIKE :role ')
        ->setParameters([ 'role' => '%AGENT%' ])
        ->getQuery()
        ->getResult();
        
        return $this->render('admin/utilisateur/agents/index.html.twig', compact('agents'));
    }

    /**
     * @Route("/admin/agents/new", name="app_new_agent", methods={"GET", "POST"})
     */
    public function new(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $plainPassword = $form->get('plainPassword')->getData();
            $user->setPassword(
                $passwordEncoder->hashPassword(
                    $user,
                    $plainPassword
                )
            );
            $user->setRoles(['ROLE_AGENT']);
            $user->setIsVerified(true);
            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                    ->from(new Address('admin@crts.ma', 'Registration Admin'))
                    ->to($user->getEmail())
                    ->subject('Administration | CRTS')
                    ->htmlTemplate('emails/registration/infos_connexion.html.twig')
                    ->context([
                        'mail' => $user->getEmail(),
                        'password' => $plainPassword,
                    ])
                    ;

            $this->mailer->send($email);
            $this->addFlash('success', 'Agent ajouté avec succès !');
            return $this->redirectToRoute('app_agents');
        }

        return $this->render('admin/utilisateur/agents/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/agents/{id<[0-9]+>}/edit", name="app_edit_agent", methods={"GET", "POST"})
     */
    public function edit(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager, User $user): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $user, ['default-from' => "edit"]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $plainPassword = $form->get('plainPassword')->getData();
            if($plainPassword){
                $user->setPassword(
                    $passwordEncoder->hashPassword(
                        $user,
                        $plainPassword
                    )
                );
            }
            $entityManager->flush();
            $this->addFlash('success', 'Agent modifié avec succès !');
            return $this->redirectToRoute('app_agents');
        }

        return $this->render('admin/utilisateur/agents/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/agents/{id<[0-9]+>}', name: 'app_agent_delete', methods: ["POST"])]
    public function delete(Request $request, User $agent, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('agent_deletion_' . $agent->getId(), $request->request->get('csrf_token'))) {
            $em->remove($agent);
            $em->flush();

            $this->addFlash('info', 'Agent supprimé avec succès !');
        }

        return $this->redirectToRoute('app_agents');
    }

    #[Route('/admin/agents/actif/{id<[0-9]+>}', name: 'app_agent_actif', methods: ["POST"])]
    public function actif(Request $request, User $agent, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('agent_actif_' . $agent->getId(), $request->request->get('csrf_token'))) {
            $agent->setIsVerified(!$agent->isVerified());
            $em->flush();
            $this->addFlash('success', 'Status modifié avec succès !');
        }

        return $this->redirectToRoute('app_agents');
    }

}
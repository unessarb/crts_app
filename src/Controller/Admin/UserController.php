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

class UserController extends AbstractController
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    
    #[Route('/admin/users', name: 'app_users')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->createQueryBuilder('a')
        ->where('a.roles LIKE :role ')
        ->setParameters([ 'role' => '%USER%' ])
        ->getQuery()
        ->getResult();
        
        return $this->render('admin/utilisateur/users/index.html.twig', compact('users'));
    }

    /**
     * @Route("/admin/users/new", name="app_new_user", methods={"GET", "POST"})
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
            $user->setRoles(['ROLE_USER']);
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
            $this->addFlash('success', 'Utilisateur ajouté avec succès !');
            return $this->redirectToRoute('app_users');
        }

        return $this->render('admin/utilisateur/users/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/users/{id<[0-9]+>}/edit", name="app_edit_user", methods={"GET", "POST"})
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
            $this->addFlash('success', 'Utilisateur modifié avec succès !');
            return $this->redirectToRoute('app_users');
        }

        return $this->render('admin/utilisateur/users/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/users/{id<[0-9]+>}', name: 'app_user_delete', methods: ["POST"])]
    public function delete(Request $request, User $user, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('user_deletion_' . $user->getId(), $request->request->get('csrf_token'))) {
            $em->remove($user);
            $em->flush();

            $this->addFlash('info', 'Utilisateur supprimé avec succès !');
        }

        return $this->redirectToRoute('app_users');
    }

    #[Route('/admin/users/actif/{id<[0-9]+>}', name: 'app_user_actif', methods: ["POST"])]
    public function actif(Request $request, User $user, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('user_actif_' . $user->getId(), $request->request->get('csrf_token'))) {
            $user->setIsVerified(!$user->isVerified());
            $em->flush();
            $this->addFlash('success', 'Status modifié avec succès !');
        }

        return $this->redirectToRoute('app_users');
    }


}
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

class AdminController extends AbstractController
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    
    #[Route('/admin/admin', name: 'app_admins')]
    public function listAdmins(UserRepository $userRepository): Response
    {
        $admins = $userRepository->createQueryBuilder('a')
        ->where('a.roles LIKE :role AND a.id <> :id')
        ->setParameters([ 'role' => '%_ADMIN%', 'id' => $this->getUser()->getId() ])
        ->getQuery()
        ->getResult();
        
        return $this->render('admin/utilisateur/admins/index.html.twig', compact('admins'));
    }

    /**
     * @Route("/admin/admin/new", name="app_new_admin", methods={"GET", "POST"})
     */
    public function registerAdmin(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager): Response
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
            $user->setRoles(['ROLE_ADMIN']);
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
            $this->addFlash('success', 'Admin ajouté avec succès !');
            return $this->redirectToRoute('app_admins');
        }

        return $this->render('admin/utilisateur/admins/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/admin/{id<[0-9]+>}/edit", name="app_edit_admin", methods={"GET", "POST"})
     */
    public function editAdmin(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager, User $user): Response
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
            $this->addFlash('success', 'Admin modifié avec succès !');
            return $this->redirectToRoute('app_admins');
        }

        return $this->render('admin/utilisateur/admins/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/admin/{id<[0-9]+>}', name: 'app_admin_delete', methods: ["POST"])]
    public function deleteAdmin(Request $request, User $admin, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('admin_deletion_' . $admin->getId(), $request->request->get('csrf_token'))) {
            $em->remove($admin);
            $em->flush();

            $this->addFlash('info', 'Admin supprimé avec succès !');
        }

        return $this->redirectToRoute('app_admins');
    }

    #[Route('/admin/admins/actif/{id<[0-9]+>}', name: 'app_admin_actif', methods: ["POST"])]
    public function actif(Request $request, User $admin, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('admin_actif_' . $admin->getId(), $request->request->get('csrf_token'))) {
            $admin->setIsVerified(!$admin->isVerified());
            $em->flush();
            $this->addFlash('success', 'Status modifié avec succès !');
        }

        return $this->redirectToRoute('app_admins');
    }
}
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

class RegieController extends AbstractController
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    
    #[Route('/admin/regies', name: 'app_regies')]
    public function index(UserRepository $userRepository): Response
    {
        $regies = $userRepository->createQueryBuilder('a')
        ->where('a.roles LIKE :role ')
        ->setParameters([ 'role' => '%REGIE%' ])
        ->getQuery()
        ->getResult();
        
        return $this->render('admin/utilisateur/regies/index.html.twig', compact('regies'));
    }

    /**
     * @Route("/admin/regies/new", name="app_new_regie", methods={"GET", "POST"})
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
            $user->setRoles(['ROLE_REGIE']);
            $user->setIsVerified(true);
            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                    ->from(new Address('admin@crts.ma', 'Registration Regie'))
                    ->to($user->getEmail())
                    ->subject('Administration | CRTS')
                    ->htmlTemplate('emails/registration/infos_connexion.html.twig')
                    ->context([
                        'mail' => $user->getEmail(),
                        'password' => $plainPassword,
                    ])
                    ;

            $this->mailer->send($email);
            $this->addFlash('success', 'Regie ajouté avec succès !');
            return $this->redirectToRoute('app_regies');
        }

        return $this->render('admin/utilisateur/regies/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/regies/{id<[0-9]+>}/edit", name="app_edit_regie", methods={"GET", "POST"})
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
            $this->addFlash('success', 'Regie modifié avec succès !');
            return $this->redirectToRoute('app_regies');
        }

        return $this->render('admin/utilisateur/regies/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/regies/{id<[0-9]+>}', name: 'app_regie_delete', methods: ["POST"])]
    public function delete(Request $request, User $regie, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('regie_deletion_' . $regie->getId(), $request->request->get('csrf_token'))) {
            $em->remove($regie);
            $em->flush();

            $this->addFlash('info', 'Regie supprimé avec succès !');
        }

        return $this->redirectToRoute('app_regies');
    }

    #[Route('/admin/regies/actif/{id<[0-9]+>}', name: 'app_regie_actif', methods: ["POST"])]
    public function actif(Request $request, User $regie, EntityManagerInterface $em): Response
    {

        if ($this->isCsrfTokenValid('regie_actif_' . $regie->getId(), $request->request->get('csrf_token'))) {
            $regie->setIsVerified(!$regie->isVerified());
            $em->flush();
            $this->addFlash('success', 'Status modifié avec succès !');
        }

        return $this->redirectToRoute('app_regies');
    }

}
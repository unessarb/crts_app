<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"GET","POST"})
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $this->addFlash('info', 'Already logged in!');
            return $this->redirectToRoute('app_home');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"POST"})
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/profile/{id<[0-9]+>}", name="app_profil", methods={"GET", "POST"})
     */
    public function profile(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager, User $user): Response
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
            $this->addFlash('success', 'Profil modifié avec succès !');
            return $this->redirectToRoute('app_profil',[
                "id" => $this->getUser()->getId()
            ]);
        }

        return $this->render('admin/utilisateur/profil.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}
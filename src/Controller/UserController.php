<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


 class UserController extends AbstractController{

    #[Route('/inscription.html', name: 'user_register', methods: ['GET', 'POST'], priority: 10)]
     public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em) :Response{

         $user = new User();
         $user->setRoles(['ROLE_USER']);

            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if($form->isSubmitted()){

                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $user->getPassword()
                );
                $user->setPassword($hashedPassword);

                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre compte a bien été créé !');

                return $this->redirectToRoute('default_home');
            }

            return $this->render('user/register.html.twig', [
                'form' => $form

            ]);
     }
 }
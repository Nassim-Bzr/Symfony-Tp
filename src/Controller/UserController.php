<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController

{
    #[Route('/inscription.html', name: 'register')]
public function register(){
        $user = new User();
        $user-> setRoles(['ROLE_USER']);
        $form = $this->createForm(UserType::class, $user);

    }
}
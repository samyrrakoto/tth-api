<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
    * @Route("/login/check", name="login_check", methods={"POST"})
    */
    public function loginCheck() {
        $user = $this->getUser();
        return $this->json(array(
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ));
    }
}

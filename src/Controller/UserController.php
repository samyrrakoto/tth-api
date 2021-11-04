<?php

namespace App\Controller;

use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user_create', methods:["POST"])]
    public function createUser(Request $request, UserManager $userManager): Response
    {
        $user = $userManager->createUser($request->getContent());

        return $this->json($user, JsonResponse::HTTP_CREATED, [], ['groups' => 'user']);
    }

    #[Route('/secure/user', name: 'user_get_logged_in', methods:["GET"])]
    public function getLoggedInUser(): Response
    {
        return $this->json($this->getUser(), JsonResponse::HTTP_OK, [], ['groups' => 'user']);
    }
}


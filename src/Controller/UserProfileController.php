<?php

namespace App\Controller;

use App\Manager\UserProfileManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserProfileController extends AbstractController
{
    #[Route('/secure/user/profile', name: 'user_profile_create', methods:["POST"])]
    public function createUserProfile(Request $request, UserProfileManager $profileManager): Response
    {
        $user = $this->getUser();
        if ($user->getProfile())
        {
            return $this->json($user, JsonResponse::HTTP_OK, [], ['groups' => 'user_profile']);
        } else {
            $user = $profileManager->createUserProfile($user, $request->getContent());
            
            return $this->json($user, JsonResponse::HTTP_CREATED, [], ['groups' => 'user_profile']);
        }
    }
}

<?php

namespace App\Controller;

use App\Manager\DayManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DayController extends AbstractController
{
    private $dayManager;

    public function __construct(DayManager $dayManager)
    {
        $this->dayManager = $dayManager;
    }

    #[Route('/secure/day', name: 'day_create', methods:["POST"])]
    public function createDayByUser(Request $request): Response
    {
        $day = $this->dayManager->createDayByUser($this->getUser(), $request->getContent());

        return $this->json($day, JsonResponse::HTTP_CREATED, [], ['groups' => 'day']);
    }
}

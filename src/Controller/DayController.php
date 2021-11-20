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
    public function __construct(
        private DayManager $dayManager,
        ) {}

    #[Route('/secure/day', name: 'day_create', methods:["POST"])]
    public function createDayByUser(Request $request): Response
    {
        $day = $this->dayManager->createDayByUser($this->getUser(), $request->getContent());

        return $this->json($day, JsonResponse::HTTP_CREATED, [], ['groups' => 'day']);
    }

    #[Route('/secure/days', name: 'day_get_by_criteria', methods:["GET"])]
    public function getDaysByCriteria(Request $request): Response
    {
        $criteria = array();
        $criteria['id']             = $request->query->get('id');
        $criteria['date']           = $request->query->get('date');
        $criteria['startDate']      = $request->query->get('startDate');
        $criteria['endDate']        = $request->query->get('endDate');
        $criteria['rating']         = $request->query->get('rating');
        $criteria['startRating']    = $request->query->get('startRating');
        $criteria['endRating']      = $request->query->get('endRating');
        $criteria['page']           = $request->query->get('page');
        $criteria['resultsPerPage'] = $request->query->get('resultsPerPage');
        $criteria['orderBy']        = $request->query->get('orderBy');
        $criteria['sort']           = $request->query->get('sort');
        $days = $this->dayManager->getDaysByCriteria($this->getUser(), $criteria);

        return $this->json($days, JsonResponse::HTTP_OK, [], ['groups' => 'day']);
    }
}
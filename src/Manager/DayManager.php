<?php 

namespace App\Manager;

use App\Entity\Day;
use App\Entity\User;
use App\Manager\BaseManager;
use App\Repository\DayRepository;

class DayManager extends BaseManager
{
    private $dayRepository;

    public function __construct($em, $serializer, DayRepository $dayRepository)
    {
        parent::__construct($em, $serializer);
        $this->dayRepository = $dayRepository;
    }

    public function createDayByUser(User $user, string $payload): Day
    {
        $day = new Day();
        $day = $this->serializer->deserialize($payload, Day::class, 'json');
        $day->setUser($user);

        return $this->persistFlush($day);
    }

    public function getDaysByCriteria(User $user, array $criteria): array
    {
        return $this->dayRepository->findByCriterias(
            $user,
            $criteria['id'],
            $criteria['date'],
            $criteria['startDate'],
            $criteria['endDate'],
            $criteria['rating'],
            $criteria['startRating'],
            $criteria['endRating'],
            $criteria['page'],
            $criteria['resultsPerPage'],
            $criteria['orderBy'],
            $criteria['sort'],
        );
    }
}

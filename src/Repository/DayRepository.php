<?php

namespace App\Repository;

use App\Entity\Day;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Day|null find($id, $lockMode = null, $lockVersion = null)
 * @method Day|null findOneBy(array $criteria, array $orderBy = null)
 * @method Day[]    findAll()
 * @method Day[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Day::class);
    }

    public function findByCriterias(
        User $user,
        ?int $id,
        ?string $date,
        ?string $startDate,
        ?string $endDate,
        ?int $rating,
        ?int $startRating,
        ?int $endRating,
        ?int $page,
        ?int $resultsPerPage,
        ?string $orderBy,
        ?string $sort
    ): array
    {
        // Criteria hierarchy : id > (date || startDate === endDate) > (rating || startRating === endRating) > criteria

        $return['results'] = array();
        $return['meta'] = array();
        $uniqueResult = function(int $number)
        {
            $meta['currentPage'] = $meta['totalPages'] = $meta['resultsPerPage'] = $meta['totalResults'] = $number;

            return $meta;
        };
        if ($id) {
            $return['results'] = $this->findBy(['id' => $id, 'user' => $user]);
            $return['meta'] = $uniqueResult(count($return['results']));

            return $return;
        } elseif ($date || ($startDate && ($startDate === $endDate))) {
            $dateToFetch = ($date) ? $date : $startDate;
            $return['results'] = $this->findBy(['date' => \DateTime::createFromFormat('Y-m-d', $dateToFetch), 'user' => $user]);
            $return['meta'] = $uniqueResult(count($return['results']));

            return $return;
        } else {
            $qb = $this->createQueryBuilder('d');
            $qb->where('d.user = :user')->setParameter('user', $user);
            if ($rating || ($startRating && ($startRating === $endRating))) {
                $ratingToFetch = ($rating) ? $rating : $startRating;
                $qb->andWhere('d.rating = :ratingToFetch')->setParameter('ratingToFetch', $ratingToFetch);
            } elseif ($startRating && $endRating) {
                    $qb->andWhere('d.rating >= :startRating')->setParameter('startRating', $startRating);
                    $qb->andWhere('d.rating <= :endRating')->setParameter('endRating', $endRating);
            } else {
                if ($startRating && !$endRating) {
                    $qb->andWhere('d.rating >= :startRating')->setParameter('startRating', $startRating);
                } elseif ($endRating && !$startRating) {
                    $qb->andWhere('d.rating <= :endRating')->setParameter('endRating', $endRating);
                }
            }

            if ($startDate)
                $qb->andWhere('d.date >= :startDate')->setParameter('startDate', \DateTime::createFromFormat('!Y-m-d', $startDate));
            if ($endDate)
                $qb->andWhere('d.date <= :endDate')->setParameter('endDate', \DateTime::createFromFormat('!Y-m-d', $endDate));

            $page           = is_null($page) ? 1 : $page;
            $resultsPerPage = is_null($resultsPerPage) ? 5 : $resultsPerPage;
            $paginator      = new Paginator($qb, true);
            $nbResults      = count($paginator);
            $nbPages        = $nbResults / $resultsPerPage;
            $currentPage    = ($page > $nbPages) ? $nbPages: $page;
            $currentPage    = ceil($currentPage);
            $offset         = ($currentPage - 1) * $resultsPerPage;
            $offset         = ($offset < 0 ) ? 0 : $offset;
            $sort           = is_null($sort) ? 'DESC' :  strtoupper($sort);
            $sort           = in_array($sort, ['DESC', 'ASC']) ? $sort : 'DESC';
            $orderBy        = is_null($orderBy) ? 'date' : $orderBy;

            switch($orderBy){
                case 'rating':
                    $order = 'd.rating';
                break;
                case 'date':
                    $order = 'd.date';
                break;
                case 'mainEmotion':
                    $order = 'd.mainEmotion';
                break;
                default:
                    $order = 'd.date';
                break;
            }

            $qb->orderBy($order, $sort);
            $qb->setFirstResult($offset)->setMaxResults($resultsPerPage);

            $return['results'] = $qb->getQuery()->getResult();
            $return['meta']['currentPage']      = ($currentPage < 1) ? 1 : $currentPage;
            $return['meta']['totalPages']       = ceil($nbPages);
            $return['meta']['resultsPerPage']   = $resultsPerPage;
            $return['meta']['totalResults']     = $nbResults;
            $return['meta']['orderBy']          = $orderBy . '-' . $sort;

            return $return;
        }
    }
}

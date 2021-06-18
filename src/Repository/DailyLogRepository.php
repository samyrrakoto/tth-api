<?php

namespace App\Repository;

use App\Entity\DailyLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DailyLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method DailyLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method DailyLog[]    findAll()
 * @method DailyLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DailyLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DailyLog::class);
    }

    // /**
    //  * @return DailyLog[] Returns an array of DailyLog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DailyLog
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

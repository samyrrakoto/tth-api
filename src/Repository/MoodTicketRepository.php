<?php

namespace App\Repository;

use App\Entity\MoodTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MoodTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoodTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoodTicket[]    findAll()
 * @method MoodTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoodTicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoodTicket::class);
    }

    // /**
    //  * @return MoodTicket[] Returns an array of MoodTicket objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MoodTicket
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

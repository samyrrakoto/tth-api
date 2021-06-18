<?php

namespace App\Repository;

use App\Entity\PatientProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PatientProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientProfile[]    findAll()
 * @method PatientProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientProfile::class);
    }

    // /**
    //  * @return PatientProfile[] Returns an array of PatientProfile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PatientProfile
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

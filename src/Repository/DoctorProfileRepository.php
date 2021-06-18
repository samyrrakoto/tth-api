<?php

namespace App\Repository;

use App\Entity\DoctorProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DoctorProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoctorProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoctorProfile[]    findAll()
 * @method DoctorProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctorProfile::class);
    }

    // /**
    //  * @return DoctorProfile[] Returns an array of DoctorProfile objects
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
    public function findOneBySomeField($value): ?DoctorProfile
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

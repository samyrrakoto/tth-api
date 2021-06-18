<?php

namespace App\Repository;

use App\Entity\MedicalRelation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MedicalRelation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalRelation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalRelation[]    findAll()
 * @method MedicalRelation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalRelationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalRelation::class);
    }

    // /**
    //  * @return MedicalRelation[] Returns an array of MedicalRelation objects
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
    public function findOneBySomeField($value): ?MedicalRelation
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

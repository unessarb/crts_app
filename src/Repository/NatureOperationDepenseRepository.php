<?php

namespace App\Repository;

use App\Entity\NatureOperationDepense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NatureOperationDepense|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureOperationDepense|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureOperationDepense[]    findAll()
 * @method NatureOperationDepense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureOperationDepenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureOperationDepense::class);
    }

    // /**
    //  * @return NatureOperationDepense[] Returns an array of NatureOperationDepense objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NatureOperationDepense
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

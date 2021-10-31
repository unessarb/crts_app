<?php

namespace App\Repository;

use App\Entity\NatureOperationMarcheReconductible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NatureOperationMarcheReconductible|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureOperationMarcheReconductible|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureOperationMarcheReconductible[]    findAll()
 * @method NatureOperationMarcheReconductible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureOperationMarcheReconductibleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureOperationMarcheReconductible::class);
    }

    // /**
    //  * @return NatureOperationMarcheReconductible[] Returns an array of NatureOperationMarcheReconductible objects
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
    public function findOneBySomeField($value): ?NatureOperationMarcheReconductible
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

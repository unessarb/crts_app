<?php

namespace App\Repository;

use App\Entity\NatureOperationBonCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NatureOperationBonCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureOperationBonCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureOperationBonCommande[]    findAll()
 * @method NatureOperationBonCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureOperationBonCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureOperationBonCommande::class);
    }

    // /**
    //  * @return NatureOperationBonCommande[] Returns an array of NatureOperationBonCommande objects
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
    public function findOneBySomeField($value): ?NatureOperationBonCommande
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

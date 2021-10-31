<?php

namespace App\Repository;

use App\Entity\NatureOperationMarcheUnique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NatureOperationMarcheUnique|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureOperationMarcheUnique|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureOperationMarcheUnique[]    findAll()
 * @method NatureOperationMarcheUnique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureOperationMarcheUniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureOperationMarcheUnique::class);
    }

    // /**
    //  * @return NatureOperationMarcheUnique[] Returns an array of NatureOperationMarcheUnique objects
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
    public function findOneBySomeField($value): ?NatureOperationMarcheUnique
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

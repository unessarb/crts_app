<?php

namespace App\Repository;

use App\Entity\Tfs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tfs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfs[]    findAll()
 * @method Tfs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TfsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfs::class);
    }

    // /**
    //  * @return Tfs[] Returns an array of Tfs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tfs
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

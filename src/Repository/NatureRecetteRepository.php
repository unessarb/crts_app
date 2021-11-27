<?php

namespace App\Repository;

use App\Entity\NatureRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NatureRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureRecette[]    findAll()
 * @method NatureRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureRecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureRecette::class);
    }

    // /**
    //  * @return NatureRecette[] Returns an array of NatureRecette objects
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
    public function findOneBySomeField($value): ?NatureRecette
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

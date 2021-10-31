<?php

namespace App\Repository;

use App\Entity\NatureOperationContrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NatureOperationContrat|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureOperationContrat|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureOperationContrat[]    findAll()
 * @method NatureOperationContrat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureOperationContratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureOperationContrat::class);
    }

    // /**
    //  * @return NatureOperationContrat[] Returns an array of NatureOperationContrat objects
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
    public function findOneBySomeField($value): ?NatureOperationContrat
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

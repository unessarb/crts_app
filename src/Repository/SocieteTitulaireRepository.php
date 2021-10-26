<?php

namespace App\Repository;

use App\Entity\SocieteTitulaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SocieteTitulaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocieteTitulaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocieteTitulaire[]    findAll()
 * @method SocieteTitulaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocieteTitulaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SocieteTitulaire::class);
    }

    // /**
    //  * @return SocieteTitulaire[] Returns an array of SocieteTitulaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SocieteTitulaire
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

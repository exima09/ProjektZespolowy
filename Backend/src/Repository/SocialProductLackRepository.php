<?php

namespace App\Repository;

use App\Entity\SocialProductLack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SocialProductLack|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialProductLack|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialProductLack[]    findAll()
 * @method SocialProductLack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialProductLackRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SocialProductLack::class);
    }

    // /**
    //  * @return SocialProductLack[] Returns an array of SocialProductLack objects
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
    public function findOneBySomeField($value): ?SocialProductLack
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

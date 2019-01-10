<?php

namespace App\Repository;

use App\Entity\SocialOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SocialOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialOrder[]    findAll()
 * @method SocialOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialOrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SocialOrder::class);
    }

    // /**
    //  * @return SocialOrder[] Returns an array of SocialOrder objects
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
    public function findOneBySomeField($value): ?SocialOrder
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

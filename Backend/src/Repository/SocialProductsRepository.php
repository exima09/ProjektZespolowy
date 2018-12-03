<?php

namespace App\Repository;

use App\Entity\SocialProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SocialProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialProducts[]    findAll()
 * @method SocialProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialProductsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SocialProducts::class);
    }

    // /**
    //  * @return SocialProducts[] Returns an array of SocialProducts objects
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
    public function findOneBySomeField($value): ?SocialProducts
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

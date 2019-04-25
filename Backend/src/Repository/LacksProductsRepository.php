<?php

namespace App\Repository;

use App\Entity\LacksProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LacksProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method LacksProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method LacksProducts[]    findAll()
 * @method LacksProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LacksProductsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LacksProducts::class);
    }

    // /**
    //  * @return LacksProducts[] Returns an array of LacksProducts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LacksProducts
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

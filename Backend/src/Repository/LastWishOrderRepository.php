<?php

namespace App\Repository;

use App\Entity\LastWishOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LastWishOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method LastWishOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method LastWishOrder[]    findAll()
 * @method LastWishOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LastWishOrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LastWishOrder::class);
    }

    // /**
    //  * @return LastWishOrder[] Returns an array of LastWishOrder objects
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
    public function findOneBySomeField($value): ?LastWishOrder
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

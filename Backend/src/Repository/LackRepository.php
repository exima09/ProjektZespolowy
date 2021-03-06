<?php

namespace App\Repository;

use App\Entity\Lack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lack|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lack|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lack[]    findAll()
 * @method Lack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LackRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lack::class);
    }

    // /**
    //  * @return Lack[] Returns an array of Lack objects
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
    public function findOneBySomeField($value): ?Lack
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

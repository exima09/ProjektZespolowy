<?php

namespace App\Repository;

use App\Entity\JailJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JailJob|null find($id, $lockMode = null, $lockVersion = null)
 * @method JailJob|null findOneBy(array $criteria, array $orderBy = null)
 * @method JailJob[]    findAll()
 * @method JailJob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JailJobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JailJob::class);
    }

    // /**
    //  * @return JailJob[] Returns an array of JailJob objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JailJob
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

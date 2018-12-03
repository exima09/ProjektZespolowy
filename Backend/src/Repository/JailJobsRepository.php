<?php

namespace App\Repository;

use App\Entity\JailJobs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JailJobs|null find($id, $lockMode = null, $lockVersion = null)
 * @method JailJobs|null findOneBy(array $criteria, array $orderBy = null)
 * @method JailJobs[]    findAll()
 * @method JailJobs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JailJobsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JailJobs::class);
    }

    // /**
    //  * @return JailJobs[] Returns an array of JailJobs objects
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
    public function findOneBySomeField($value): ?JailJobs
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

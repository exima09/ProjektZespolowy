<?php

namespace App\Repository;

use App\Entity\JailJobSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JailJobSchedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method JailJobSchedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method JailJobSchedule[]    findAll()
 * @method JailJobSchedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JailJobScheduleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JailJobSchedule::class);
    }

    // /**
    //  * @return JailJobSchedule[] Returns an array of JailJobSchedule objects
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
    public function findOneBySomeField($value): ?JailJobSchedule
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

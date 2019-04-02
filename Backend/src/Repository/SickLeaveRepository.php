<?php

namespace App\Repository;

use App\Entity\SickLeave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SickLeave|null find($id, $lockMode = null, $lockVersion = null)
 * @method SickLeave|null findOneBy(array $criteria, array $orderBy = null)
 * @method SickLeave[]    findAll()
 * @method SickLeave[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SickLeaveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SickLeave::class);
    }

    // /**
    //  * @return SickLeave[] Returns an array of SickLeave objects
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
    public function findOneBySomeField($value): ?SickLeave
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

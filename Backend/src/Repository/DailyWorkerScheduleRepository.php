<?php

namespace App\Repository;

use App\Entity\DailyWorkerSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DailyWorkerSchedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method DailyWorkerSchedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method DailyWorkerSchedule[]    findAll()
 * @method DailyWorkerSchedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DailyWorkerScheduleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DailyWorkerSchedule::class);
    }

    // /**
    //  * @return DailyWorkerSchedule[] Returns an array of DailyWorkerSchedule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DailyWorkerSchedule
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

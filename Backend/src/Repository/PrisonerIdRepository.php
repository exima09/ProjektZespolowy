<?php

namespace App\Repository;

use App\Entity\PrisonerId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PrisonerId|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrisonerId|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrisonerId[]    findAll()
 * @method PrisonerId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrisonerIdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrisonerId::class);
    }

    // /**
    //  * @return PrisonerId[] Returns an array of PrisonerId objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrisonerId
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

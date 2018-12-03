<?php

namespace App\Repository;

use App\Entity\Prisoner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Prisoner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prisoner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prisoner[]    findAll()
 * @method Prisoner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrisonerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Prisoner::class);
    }

    // /**
    //  * @return Prisoner[] Returns an array of Prisoner objects
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
    public function findOneBySomeField($value): ?Prisoner
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

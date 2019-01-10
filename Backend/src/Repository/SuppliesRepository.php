<?php

namespace App\Repository;

use App\Entity\Supplies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Supplies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supplies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supplies[]    findAll()
 * @method Supplies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuppliesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Supplies::class);
    }

    // /**
    //  * @return Supplies[] Returns an array of Supplies objects
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
    public function findOneBySomeField($value): ?Supplies
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

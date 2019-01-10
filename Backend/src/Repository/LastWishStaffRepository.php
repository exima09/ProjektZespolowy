<?php

namespace App\Repository;

use App\Entity\LastWishStaff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LastWishStaff|null find($id, $lockMode = null, $lockVersion = null)
 * @method LastWishStaff|null findOneBy(array $criteria, array $orderBy = null)
 * @method LastWishStaff[]    findAll()
 * @method LastWishStaff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LastWishStaffRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LastWishStaff::class);
    }

    // /**
    //  * @return LastWishStaff[] Returns an array of LastWishStaff objects
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
    public function findOneBySomeField($value): ?LastWishStaff
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

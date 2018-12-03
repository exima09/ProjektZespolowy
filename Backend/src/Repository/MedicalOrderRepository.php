<?php

namespace App\Repository;

use App\Entity\MedicalOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MedicalOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalOrder[]    findAll()
 * @method MedicalOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalOrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MedicalOrder::class);
    }

    // /**
    //  * @return MedicalOrder[] Returns an array of MedicalOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MedicalOrder
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

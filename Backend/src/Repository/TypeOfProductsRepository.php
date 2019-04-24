<?php

namespace App\Repository;

use App\Entity\TypeOfProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeOfProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOfProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOfProducts[]    findAll()
 * @method TypeOfProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOfProductsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeOfProducts::class);
    }

    // /**
    //  * @return TypeOfProducts[] Returns an array of TypeOfProducts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeOfProducts
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

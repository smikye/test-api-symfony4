<?php

namespace App\Repository;

use App\Entity\TimeUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TimeUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimeUnit[]    findAll()
 * @method TimeUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeUnitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TimeUnit::class);
    }

//    /**
//     * @return TimeUnit[] Returns an array of TimeUnit objects
//     */
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
    public function findOneBySomeField($value): ?TimeUnit
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

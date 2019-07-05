<?php

namespace App\Repository;

use App\Entity\Retry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Retry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Retry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Retry[]    findAll()
 * @method Retry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RetryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Retry::class);
    }

    // /**
    //  * @return Retry[] Returns an array of Retry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Retry
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

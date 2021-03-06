<?php

namespace App\Repository;

use App\Entity\Consommation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Consommation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consommation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consommation[]    findAll()
 * @method Consommation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsommationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Consommation::class);
    }

    /**
     * @return Consommation[] Returns an array of Consommation objects between dateInf and dateSup
     */
    public function findByDateRange($dateInf, $dateSup)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c.createdAt, c.kw, c.kwh
            FROM App\Entity\Consommation c
            WHERE c.createdAt >= :dateInf
            AND c.createdAt <= :dateSup
            ORDER BY c.createdAt ASC'
        )->setParameter('dateInf', date('Y-m-d H:i:s', $dateInf))->setParameter('dateSup', date('Y-m-d H:i:s', $dateSup));

        return $query->execute();

        //return $this->createQueryBuilder('c')
        //    ->andWhere('c.createdAt >= :dateInf')
        //    ->andWhere('c.createdAt <= :dateSup')
        //    ->setParameter('dateInf', $dateInf)
        //    ->setParameter('dateSup', $dateSup)
        //    ->orderBy('c.id', 'ASC')
        ////    ->setMaxResults(10)
        //    ->getQuery()
        //    ->getResult()
        //;
    }
    
    // /**
    //  * @return Consommation[] Returns an array of Consommation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Consommation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

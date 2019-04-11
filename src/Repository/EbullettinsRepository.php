<?php

namespace App\Repository;

use App\Entity\Ebullettins;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ebullettins|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ebullettins|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ebullettins[]    findAll()
 * @method Ebullettins[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EbullettinsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ebullettins::class);
    }

    // /**
    //  * @return Reports[] Returns an array of Reports objects
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
    public function findOneBySomeField($value): ?Reports
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

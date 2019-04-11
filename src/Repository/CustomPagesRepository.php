<?php

namespace App\Repository;

use App\Entity\CustomPages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomPages|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomPages|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomPages[]    findAll()
 * @method CustomPages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomPagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomPages::class);
    }

    // /**
    //  * @return CustomPages[] Returns an array of CustomPages objects
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
    public function findOneBySomeField($value): ?CustomPages
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

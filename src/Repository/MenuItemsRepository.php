<?php

namespace App\Repository;

use App\Entity\MenuItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MenuItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuItems[]    findAll()
 * @method MenuItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuItemsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MenuItems::class);
    }

    // /**
    //  * @return MenuItems[] Returns an array of MenuItems objects
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
    public function findOneBySomeField($value): ?MenuItems
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

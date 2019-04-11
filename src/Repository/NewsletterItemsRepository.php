<?php

namespace App\Repository;

use App\Entity\NewsletterItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NewsletterItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsletterItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsletterItems[]    findAll()
 * @method NewsletterItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsletterItemsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NewsletterItems::class);
    }

    // /**
    //  * @return NewsletterItems[] Returns an array of NewsletterItems objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsletterItems
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

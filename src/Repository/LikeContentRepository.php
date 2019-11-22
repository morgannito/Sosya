<?php

namespace App\Repository;

use App\Entity\LikeContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LikeContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeContent[]    findAll()
 * @method LikeContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LikeContent::class);
    }

    // /**
    //  * @return LikeContent[] Returns an array of LikeContent objects
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
    public function findOneBySomeField($value): ?LikeContent
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

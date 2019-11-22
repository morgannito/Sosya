<?php

namespace App\Repository;

use App\Entity\CommentContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentContent[]    findAll()
 * @method CommentContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentContent::class);
    }

    // /**
    //  * @return CommentContent[] Returns an array of CommentContent objects
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
    public function findOneBySomeField($value): ?CommentContent
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

<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Content::class);
    }

    public function findPublication($IDtoSend, $limit, $offset = 0)
    {
        $query = $this->createQueryBuilder('c')
                    ->where('c.user in (:user)')
                    ->setParameter('user', $IDtoSend)
                    ->andWhere('c.enable = 1')
                    ->orderBy('c.createAt', 'DESC')
                    ->setFirstResult($offset)
                    ->setMaxResults($limit)
                    ->getQuery();
 
        return $query->getResult();
    }

    public function getCountPublication($followingID)
    {
        $query = $this->createQueryBuilder('c')
                    ->where('c.user in (:user)')
                    ->setParameter('user', $followingID)
                    ->getQuery();

        $query->select(
            $query->expr()->count('c.id')
        );
        return $query->getResult();
    }

    // /**
    //  * @return Content[] Returns an array of Content objects
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
    public function findOneBySomeField($value): ?Content
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

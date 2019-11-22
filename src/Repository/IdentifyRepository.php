<?php

namespace App\Repository;

use App\Entity\Identify;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Identify|null find($id, $lockMode = null, $lockVersion = null)
 * @method Identify|null findOneBy(array $criteria, array $orderBy = null)
 * @method Identify[]    findAll()
 * @method Identify[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentifyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Identify::class);
    }

    // /**
    //  * @return Identify[] Returns an array of Identify objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Identify
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

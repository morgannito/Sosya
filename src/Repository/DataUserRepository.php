<?php

namespace App\Repository;

use App\Entity\DataUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DataUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataUser[]    findAll()
 * @method DataUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DataUser::class);
    }

    // /**
    //  * @return DataUser[] Returns an array of DataUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DataUser
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

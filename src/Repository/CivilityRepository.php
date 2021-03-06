<?php

namespace App\Repository;

use App\Entity\Civility;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Civility|null find($id, $lockMode = null, $lockVersion = null)
 * @method Civility|null findOneBy(array $criteria, array $orderBy = null)
 * @method Civility[]    findAll()
 * @method Civility[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CivilityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Civility::class);
    }

    public function findByWord($keyword){
        $query = $this->createQueryBuilder('c')
            ->where('c.name LIKE :key')->orWhere('c.firstName LIKE :key')
            ->setParameter('key' , $keyword.'%')->getQuery();
 
        return $query->getResult();
    }
    
    // /**
    //  * @return Civility[] Returns an array of Civility objects
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
    public function findOneBySomeField($value): ?Civility
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

<?php

namespace App\Repository;

use App\Entity\ImgContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ImgContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImgContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImgContent[]    findAll()
 * @method ImgContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImgContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImgContent::class);
    }

    // /**
    //  * @return ImgContent[] Returns an array of ImgContent objects
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
    public function findOneBySomeField($value): ?ImgContent
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

<?php

namespace App\Repository;

use App\Entity\Algalapis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Algalapis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Algalapis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Algalapis[]    findAll()
 * @method Algalapis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlgalapisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Algalapis::class);
    }

    // /**
    //  * @return Algalapis[] Returns an array of Algalapis objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Algalapis
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Instruktorius;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Instruktorius|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instruktorius|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instruktorius[]    findAll()
 * @method Instruktorius[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstruktoriusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Instruktorius::class);
    }

    // /**
    //  * @return Instruktorius[] Returns an array of Instruktorius objects
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
    public function findOneBySomeField($value): ?Instruktorius
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

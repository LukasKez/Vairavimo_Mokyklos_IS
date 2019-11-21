<?php

namespace App\Repository;

use App\Entity\Filialas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Filialas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filialas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filialas[]    findAll()
 * @method Filialas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilialasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filialas::class);
    }

    // /**
    //  * @return Filialas[] Returns an array of Filialas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Filialas
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

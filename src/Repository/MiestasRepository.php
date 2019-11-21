<?php

namespace App\Repository;

use App\Entity\Miestas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Miestas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Miestas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Miestas[]    findAll()
 * @method Miestas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiestasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Miestas::class);
    }

    // /**
    //  * @return Miestas[] Returns an array of Miestas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Miestas
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

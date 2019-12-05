<?php

namespace App\Repository;

use App\Entity\Marsrutas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Marsrutas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marsrutas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marsrutas[]    findAll()
 * @method Marsrutas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarsrutasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marsrutas::class);
    }

    // /**
    //  * @return Marsrutas[] Returns an array of Marsrutas objects
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
    public function findOneBySomeField($value): ?Marsrutas
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

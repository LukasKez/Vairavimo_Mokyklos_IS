<?php

namespace App\Repository;

use App\Entity\Egzaminas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Egzaminas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Egzaminas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Egzaminas[]    findAll()
 * @method Egzaminas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EgzaminasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Egzaminas::class);
    }

    // /**
    //  * @return Egzaminas[] Returns an array of Egzaminas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Egzaminas
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

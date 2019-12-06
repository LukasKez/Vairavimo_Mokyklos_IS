<?php

namespace App\Repository;

use App\Entity\EgzaminuTipai;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EgzaminuTipai|null find($id, $lockMode = null, $lockVersion = null)
 * @method EgzaminuTipai|null findOneBy(array $criteria, array $orderBy = null)
 * @method EgzaminuTipai[]    findAll()
 * @method EgzaminuTipai[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EgzaminuTipaiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EgzaminuTipai::class);
    }

    // /**
    //  * @return EgzaminuTipai[] Returns an array of EgzaminuTipai objects
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
    public function findOneBySomeField($value): ?EgzaminuTipai
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

<?php

namespace App\Repository;

use App\Entity\Klientas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Klientas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Klientas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Klientas[]    findAll()
 * @method Klientas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KlientasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Klientas::class);
    }

    // /**
    //  * @return Klientas[] Returns an array of Klientas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Klientas
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

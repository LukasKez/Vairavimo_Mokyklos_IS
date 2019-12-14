<?php

namespace App\Repository;

use App\Entity\Pravaziavimas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pravaziavimas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pravaziavimas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pravaziavimas[]    findAll()
 * @method Pravaziavimas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PravaziavimasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pravaziavimas::class);
    }

    // /**
    //  * @return Pravaziavimas[] Returns an array of Pravaziavimas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pravaziavimas
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

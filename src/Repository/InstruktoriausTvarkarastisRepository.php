<?php

namespace App\Repository;

use App\Entity\InstruktoriausTvarkarastis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method InstruktoriausTvarkarastis|null find($id, $lockMode = null, $lockVersion = null)
 * @method InstruktoriausTvarkarastis|null findOneBy(array $criteria, array $orderBy = null)
 * @method InstruktoriausTvarkarastis[]    findAll()
 * @method InstruktoriausTvarkarastis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstruktoriausTvarkarastisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstruktoriausTvarkarastis::class);
    }

    // /**
    //  * @return InstruktoriausTvarkarastis[] Returns an array of InstruktoriausTvarkarastis objects
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
    public function findOneBySomeField($value): ?InstruktoriausTvarkarastis
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

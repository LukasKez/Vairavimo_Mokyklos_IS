<?php

namespace App\Repository;

use App\Entity\KlientoTvarkarastis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method KlientoTvarkarastis|null find($id, $lockMode = null, $lockVersion = null)
 * @method KlientoTvarkarastis|null findOneBy(array $criteria, array $orderBy = null)
 * @method KlientoTvarkarastis[]    findAll()
 * @method KlientoTvarkarastis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KlientoTvarkarastisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KlientoTvarkarastis::class);
    }

    // /**
    //  * @return KlientoTvarkarastis[] Returns an array of KlientoTvarkarastis objects
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
    public function findOneBySomeField($value): ?KlientoTvarkarastis
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

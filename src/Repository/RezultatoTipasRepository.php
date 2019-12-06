<?php

namespace App\Repository;

use App\Entity\RezultatoTipas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RezultatoTipas|null find($id, $lockMode = null, $lockVersion = null)
 * @method RezultatoTipas|null findOneBy(array $criteria, array $orderBy = null)
 * @method RezultatoTipas[]    findAll()
 * @method RezultatoTipas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RezultatoTipasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RezultatoTipas::class);
    }

    // /**
    //  * @return RezultatoTipas[] Returns an array of RezultatoTipas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RezultatoTipas
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

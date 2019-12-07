<?php

namespace App\Repository;

use App\Entity\Marke;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Marke|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marke|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marke[]    findAll()
 * @method Marke[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marke::class);
    }
}

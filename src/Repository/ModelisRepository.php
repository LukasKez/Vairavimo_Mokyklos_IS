<?php

namespace App\Repository;

use App\Entity\Modelis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Modelis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modelis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modelis[]    findAll()
 * @method Modelis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modelis::class);
    }
}

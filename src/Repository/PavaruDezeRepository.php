<?php

namespace App\Repository;

use App\Entity\PavaruDeze;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PavaruDeze|null find($id, $lockMode = null, $lockVersion = null)
 * @method PavaruDeze|null findOneBy(array $criteria, array $orderBy = null)
 * @method PavaruDeze[]    findAll()
 * @method PavaruDeze[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PavaruDezeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PavaruDeze::class);
    }
}

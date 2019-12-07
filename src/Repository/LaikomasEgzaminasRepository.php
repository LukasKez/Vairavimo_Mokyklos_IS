<?php

namespace App\Repository;

use App\Entity\LaikomasEgzaminas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LaikomasEgzaminas|null find($id, $lockMode = null, $lockVersion = null)
 * @method LaikomasEgzaminas|null findOneBy(array $criteria, array $orderBy = null)
 * @method LaikomasEgzaminas[]    findAll()
 * @method LaikomasEgzaminas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaikomasEgzaminasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LaikomasEgzaminas::class);
    }

    /**
    / * @return LaikomasEgzaminas[] Returns an array of LaikomasEgzaminas objects
    **/
    public function findByInstruktorius($id)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e
            FROM App\Entity\LaikomasEgzaminas e
            WHERE e.instruktorius = :id'
        )->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }

    /*
    public function findOneBySomeField($value): ?LaikomasEgzaminas
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

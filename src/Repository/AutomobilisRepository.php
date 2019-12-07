<?php

namespace App\Repository;

use App\Entity\TransportoPriemone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Filialas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filialas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filialas[]    findAll()
 * @method Filialas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutomobilisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransportoPriemone::class);
    }


        public function AutomobilisInfo() : array
        {
            $entityManager = $this->getEntityManager();

            $conn = $this->getEntityManager()->getConnection();

            $sql = '
            SELECT
                transporto_priemone.id,
                transporto_priemone.valstybiniai_nr,
                transporto_priemone.pagaminimo_metai,
                transporto_priemone.ilguma,
                transporto_priemone.plokstuma,
                transporto_priemone.kebulas,
                transporto_priemone.kategorija,
                modelis.pavadinimas AS modelis,
                marke.pavadinimas As markes_pav,
                pavaru_deze.pavadinimas AS deze,
                transporto_priemones_busena.pavadinimas AS busenos_pav,
                filialas.pavadinimas as filialo_pav
            FROM
                transporto_priemone
            INNER JOIN pavaru_deze ON pavaru_deze.id = transporto_priemone.pavaru_deze
            INNER JOIN transporto_priemones_busena ON transporto_priemones_busena.id = transporto_priemone.busena
            INNER JOIN modelis ON modelis.id = transporto_priemone.fk_modelis
            INNER JOIN marke ON marke.id = modelis.fk_marke_id
            LEFT JOIN filialas ON fk_filialas = filialas.id
                ORDER BY id';
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
       }
}

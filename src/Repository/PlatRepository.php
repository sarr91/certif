<?php

namespace App\Repository;

use App\Entity\Plat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Plat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plat[]    findAll()
 * @method Plat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plat::class);
    }

    public function findThree()
    {
        return $this->createQueryBuilder('fls') //'fls est un alias 
            // ->andWhere('fls.id > :val') // on cherche un id supérieur à une certaine valeur (WHERE)
            // ->setParameter('val', 0) // on défini la valeur
            ->orderBy('fls.id', 'DESC') // tri par id décroissant (ORDER BY)
            ->setMaxResults(4) // on sélectionne 6 résultats (LIMIT)
            ->getQuery() // requete
            ->getResult() // résultat(s)
        ;
    }

    public function trouverTrois()
    {
        $bdd = $this->getEntityManager()->getConnection();
        $req = $bdd->prepare('SELECT * FROM plat ORDER BY id DESC LIMIT 4');
        $req->executeQuery();
        return $req->fetchAll();
    }

    // /**
    //  * @return Plat[] Returns an array of Plat objects
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
    public function findOneBySomeField($value): ?Plat
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

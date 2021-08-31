<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    public function findSix()
    {
        return $this->createQueryBuilder('fls') //'fls est un alias 
            // ->andWhere('fls.id > :val') // on cherche un id supérieur à une certaine valeur (WHERE)
            // ->setParameter('val', 0) // on défini la valeur
            ->orderBy('fls.id', 'DESC') // tri par id décroissant (ORDER BY)
            ->setMaxResults(6) // on sélectionne 6 résultats (LIMIT)
            ->getQuery() // requete
            ->getResult() // résultat(s)
        ;
    }

    public function trouverSix()
    {
        $bdd = $this->getEntityManager()->getConnection();
        $req = $bdd->prepare('SELECT * FROM restaurant ORDER BY id DESC LIMIT 6');
        $req->executeQuery();
        return $req->fetchAll();
    }
}


    // /**
    //  * @return Restaurant[] Returns an array of Restaurant objects
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
    public function findOneBySomeField($value): ?Restaurant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    
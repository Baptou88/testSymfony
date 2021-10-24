<?php

namespace App\Repository;

use App\Classes\Month;
use App\Entity\HeureProjet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HeureProjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeureProjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeureProjet[]    findAll()
 * @method HeureProjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeureProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeureProjet::class);
    }

    // /**
    //  * @return HeureProjet[] Returns an array of HeureProjet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeureProjet
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findbymonth(Month $month, int $employeid){

        $query = $this->createQueryBuilder('h');
        //$query = $query->andWhere($query->expr()->between('h.date', $month->getFirstDay()->format(), $month->getLastDay()));
        $query = $query
            ->andWhere($query->expr()->between('h.Date', ":d", ":f"))
            ->andWhere("h.Employe = :e")
            ->setParameter(":d",$month->getFirstDay())
            ->setParameter(":f",$month->getLastDay())
            ->setParameter(":e", $employeid)
            ->orderBy("h.Date","ASC")
            ->getQuery()
            ->getResult();
        $result = [];
        foreach ($query as $event){
            $date = $event->getDate()->format('Y-m-d');
            if (!isset($result[$date])){
                $result[$date] = [$event];
            } else{
                $result[$date][] = $event;
            }
        };
        //return $query;
        return $result;
    }
}

<?php

namespace App\Repository;

use App\Entity\Clients;
use App\Entity\Projects;
use App\Entity\ProjectSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Project;


/**
 * @method Projects|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projects|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projects[]    findAll()
 * @method Projects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projects::class);
    }
    /**
     * Undocumented function
     *
     * @return Project[]
     */
    public function findLatest(): array
    {
       return $this->createQueryBuilder('p')
        //->where('p.type=1')
        ->setMaxResults(2)
        ->getQuery()
        ->getResult(); 
    }

    /**
     * fins All projects visible
     *
     * @param ProjectSearch $search
     * @return Query
     */
    public function findAllVisible(ProjectSearch $search): Query
    {
        $query = $this->createQueryBuilder('p');
        $query = $query->innerJoin(Clients::class,"c");

        if ($search->getTypeProjet()) {

            $query = $query
                ->andWhere('p.TypeProjet = :typeproject')
                ->setParameter('typeproject' , $search->getTypeProjet());

        }
        if ($search->getOptions()->count() > 0 ) {

                foreach ($search->getOptions() as $key => $option)
                {

                    $query = $query
                        ->andWhere(":option$key MEMBER OF p.options")
                        ->setParameter("option$key",$option);
                }
        }

        if ($search->getProjects()->count()>0)
        {

            foreach ($search->getProjects() as $key => $pr)
            {

//                $test = $pr->getId();
//                dump($test);
//                $query = $query
//                    ->andWhere("p.id = :proj$key")
//                    ->setParameter("proj$key",$test);
            }
            $query = $query
                ->andWhere("p.id IN(:projects)")
                ->setParameter('projects',($search->getProjects()));

        }

        dump($query->getParameters());
        return $query->getQuery();
    }
    // /**
    //  * @return Projects[] Returns an array of Projects objects
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
    public function findOneBySomeField($value): ?Projects
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOneByIdJoinedClient($id)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin(Clients::class,"c")
            ->andWhere('p.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findAllByClient(int $idClient){
        return $this->createQueryBuilder('p')
            ->andWhere('p.clients = :val')
            ->setParameter('val', $idClient)
            ->getQuery()
            //->getOneOrNullResult()
            ->getResult()
            //->getArrayResult()

            ;
    }

    public function search(string $project)
    {

        return $this->createQueryBuilder('p')
            ->where('p.code LIKE :project')
            ->setParameter('project',"%$project%")
            ->setMaxResults(15)
            ->getQuery()
            ->getArrayResult();
    }
}

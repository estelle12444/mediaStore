<?php

namespace App\Repository;

use App\Entity\ArticleVoix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleVoix|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleVoix|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleVoix[]    findAll()
 * @method ArticleVoix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleVoixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleVoix::class);
    }

    public function SearchVoix($mots){
        $query = $this->createQueryBuilder('d');
        $query->where('d.active =1');
        if($mots != null){
            $query->andWhere('MATCH_AGAINST(d.titre, d.description) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);
        }
        
        return $query->getQuery()->getResult();
    }
     /**
     * @return ArticleVoix[]
     */

    public function LastFree(){
        return $this->createQueryBuilder('p')
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(6)
                ->getQuery()
                ->getResult();
     } 

    // /**
    //  * @return ArticleVoix[] Returns an array of ArticleVoix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleVoix
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

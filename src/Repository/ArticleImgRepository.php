<?php

namespace App\Repository;

use App\Entity\ArticleImg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleImg|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleImg|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleImg[]    findAll()
 * @method ArticleImg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleImgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleImg::class);
    }

    /**
     * Recherche les annonces en fonction du formulaire
     * @return void 
     */

    public function Search($mots){
        $query = $this->createQueryBuilder('a');
        $query->Where('a.active =1');
        if($mots != null){
            $query->Where('MATCH_AGAINST(a.titre, a.description) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);
        }
        
        return $query->getQuery()->getResult();
    }


    /**
     * @return ArticleImg[]
     */

    public function LastFree(){
        return $this->createQueryBuilder('p')
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(6)
                ->getQuery()
                ->getResult();
     } 
    // /**
    //  * @return ArticleImg[] Returns an array of ArticleImg objects
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
    public function findOneBySomeField($value): ?ArticleImg
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

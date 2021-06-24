<?php

namespace App\Repository;

use App\Entity\ArticleIllustration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleIllustration|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleIllustration|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleIllustration[]    findAll()
 * @method ArticleIllustration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleIllustrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleIllustration::class);
    }

    public function SearchIllustration($mots){
        $query = $this->createQueryBuilder('b');
        $query->where('b.active =1');
        if($mots != null){
            $query->andWhere('MATCH_AGAINST(b.titre, b.description) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);
        }
        
        return $query->getQuery()->getResult();
    }
     /**
     * @return ArticleIllustration[]
     */

    public function LastFree(){
        return $this->createQueryBuilder('p')
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(6)
                ->getQuery()
                ->getResult();
     } 

    // /**
    //  * @return ArticleIllustration[] Returns an array of ArticleIllustration objects
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
    public function findOneBySomeField($value): ?ArticleIllustration
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

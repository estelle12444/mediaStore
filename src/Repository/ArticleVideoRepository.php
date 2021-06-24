<?php

namespace App\Repository;

use App\Entity\ArticleVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleVideo[]    findAll()
 * @method ArticleVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleVideo::class);
    }

    public function SearchVideo($mots)
    {
        $query = $this->createQueryBuilder('c');
        $query->where('c.active =1');
        if ($mots != null) {
            $query->andWhere('MATCH_AGAINST(c.titre, c.description) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);
        }

        return $query->getQuery()->getResult();
    }
    /**
     * @return ArticleVideo[]
     */

    public function LastFree()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return ArticleVideo[] Returns an array of ArticleVideo objects
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
    public function findOneBySomeField($value): ?ArticleVideo
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

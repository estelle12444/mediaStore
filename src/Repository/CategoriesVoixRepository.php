<?php

namespace App\Repository;

use App\Entity\CategoriesVoix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoriesVoix|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesVoix|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesVoix[]    findAll()
 * @method CategoriesVoix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesVoixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriesVoix::class);
    }

    // /**
    //  * @return CategoriesVoix[] Returns an array of CategoriesVoix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoriesVoix
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

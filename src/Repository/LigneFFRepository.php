<?php

namespace App\Repository;

use App\Entity\LigneFF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneFF|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneFF|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneFF[]    findAll()
 * @method LigneFF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneFFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneFF::class);
    }

    // /**
    //  * @return LigneFF[] Returns an array of LigneFF objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LigneFF
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

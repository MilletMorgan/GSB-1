<?php

namespace App\Repository;

use App\Entity\LigneHF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneHF|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneHF|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneHF[]    findAll()
 * @method LigneHF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneHFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneHF::class);
    }

    // /**
    //  * @return LigneHF[] Returns an array of LigneHF objects
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
    public function findOneBySomeField($value): ?LigneHF
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

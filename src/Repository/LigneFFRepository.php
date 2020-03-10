<?php

namespace App\Repository;

use App\Entity\LigneFf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneFf|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneFf|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneFf[]    findAll()
 * @method LigneFf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneFFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneFf::class);
    }

    // /**
    //  * @return LigneFf[] Returns an array of LigneFf objects
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
    public function findOneBySomeField($value): ?LigneFf
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

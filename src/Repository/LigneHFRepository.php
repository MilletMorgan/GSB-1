<?php

namespace App\Repository;

use App\Entity\LigneHf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneHf|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneHf|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneHf[]    findAll()
 * @method LigneHf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneHFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneHf::class);
    }

    // /**
    //  * @return LigneHf[] Returns an array of LigneHf objects
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


    /*
    public function findOneBySomeField($value): ?LigneHf
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

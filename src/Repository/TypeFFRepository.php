<?php

namespace App\Repository;

use App\Entity\TypeFF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeFF|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeFF|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeFF[]    findAll()
 * @method TypeFF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeFFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeFF::class);
    }

    // /**
    //  * @return TypeFF[] Returns an array of TypeFF objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeFF
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

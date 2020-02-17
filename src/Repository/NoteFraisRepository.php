<?php


namespace App\Repository;


use App\Entity\NoteFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NoteFrais|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteFrais|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteFrais[]    findAll()
 * @method NoteFrais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteFraisRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, NoteFrais::class);
	}
}
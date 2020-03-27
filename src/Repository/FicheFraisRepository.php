<?php


namespace App\Repository;


use App\Entity\FicheFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FicheFrais|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheFrais|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheFrais[]    findAll()
 * @method FicheFrais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheFraisRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, FicheFrais::class);
	}
}
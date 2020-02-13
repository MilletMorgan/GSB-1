<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheFraisRepository")
 */
class FicheFrais
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;
	/**
	 * @ORM\Column(type="integer")
	 */
	private $nbJustificatifs;
	/**
	 * @ORM\Column(type="integer")
	 */
	private $montant;
	/**
	 * @ORM\Column(type="datetime")
	 */
	private $dateModif;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $userId;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getNbJustificatifs(): ?int
	{
		return $this->nbJustificatifs;
	}

	public function setNbJustificatifs(int $nbJustificatifs): self
	{
		$this->nbJustificatifs = $nbJustificatifs;
		return $this;
	}

	public function getMontant(): ?int
	{
		return $this->montant;
	}

	public function setMontant(int $montant): self
	{
		$this->montant = $montant;
		return $this;
	}

	public function getDateModif(): ?\DateTimeInterface
	{
		return $this->dateModif;
	}

	public function setDateModif(\DateTimeInterface $dateModif): self
	{
		$this->dateModif = $dateModif;
		return $this;
	}

	public function getUserId(): ?int
	{
		return $this->userId;
	}

	public function setUserId(int $userId): self
	{
		$this->userId = $userId;

		return $this;
	}
}
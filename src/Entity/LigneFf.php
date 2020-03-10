<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneFFRepository")
 */
class LigneFf
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFFrais;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fiche", inversedBy="ligneFf")
     */
    private $fiche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="ligneFf")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeFF", inversedBy="ligneFfs")
     */
    private $typeFF;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FraisForfait", inversedBy="ligneFfs")
     */
    private $fraisForfait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFFrais(): ?\DateTimeInterface
    {
        return $this->dateFFrais;
    }

    public function setDateFFrais(\DateTimeInterface $dateFFrais): self
    {
        $this->dateFFrais = $dateFFrais;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getFiche(): ?Fiche
    {
        return $this->fiche;
    }

    public function setFiche(?Fiche $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getTypeFF(): ?typeFF
    {
        return $this->typeFF;
    }

    public function setTypeFF(?typeFF $typeFF): self
    {
        $this->typeFF = $typeFF;

        return $this;
    }

    public function getFraisForfait(): ?fraisForfait
    {
        return $this->fraisForfait;
    }

    public function setFraisForfait(?fraisForfait $fraisForfait): self
    {
        $this->fraisForfait = $fraisForfait;

        return $this;
    }
}
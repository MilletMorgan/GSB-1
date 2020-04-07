<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FraisForfaitRepository")
 */
class FraisForfait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LigneFf", inversedBy="fraisForfait")
     */
    private $ligneFf;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|LigneFf[]
     */
    public function getLigneFf(): Collection
    {
        return $this->ligneFf;
    }

    public function addLigneFF(LigneFf $ligneFF): self
    {
        if (!$this->ligneFf->contains($ligneFF)) {
            $this->ligneFf[] = $ligneFF;
            $ligneFF->setFraisForfait($this);
        }

        return $this;
    }

    public function removeLigneFF(LigneFf $ligneFF): self
    {
        if ($this->ligneFf->contains($ligneFF)) {
            $this->ligneFf->removeElement($ligneFF);
            // set the owning side to null (unless already changed)
            if ($ligneFF->getFraisForfait() === $this) {
                $ligneFF->setFraisForfait(null);
            }
        }

        return $this;
    }
}

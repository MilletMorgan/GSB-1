<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeFFRepository")
 */
class TypeFF
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
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneFf", mappedBy="typeFF")
     */
    private $ligneFf;

    public function __construct()
    {
        $this->ligneFf = new ArrayCollection();
    }

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

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

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
            $ligneFF->setTypeFF($this);
        }

        return $this;
    }

    public function removeLigneFF(LigneFf $ligneFF): self
    {
        if ($this->ligneFf->contains($ligneFF)) {
            $this->ligneFf->removeElement($ligneFF);
            // set the owning side to null (unless already changed)
            if ($ligneFF->getTypeFF() === $this) {
                $ligneFF->setTypeFF(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->label;
    }
}

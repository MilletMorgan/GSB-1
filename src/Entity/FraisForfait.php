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
     * @ORM\OneToMany(targetEntity="App\Entity\LigneFF", mappedBy="fraisForfait")
     */
    private $ligneFFs;

    public function __construct()
    {
        $this->ligneFFs = new ArrayCollection();
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
     * @return Collection|LigneFF[]
     */
    public function getLigneFFs(): Collection
    {
        return $this->ligneFFs;
    }

    public function addLigneFF(LigneFF $ligneFF): self
    {
        if (!$this->ligneFFs->contains($ligneFF)) {
            $this->ligneFFs[] = $ligneFF;
            $ligneFF->setFraisForfait($this);
        }

        return $this;
    }

    public function removeLigneFF(LigneFF $ligneFF): self
    {
        if ($this->ligneFFs->contains($ligneFF)) {
            $this->ligneFFs->removeElement($ligneFF);
            // set the owning side to null (unless already changed)
            if ($ligneFF->getFraisForfait() === $this) {
                $ligneFF->setFraisForfait(null);
            }
        }

        return $this;
    }
}

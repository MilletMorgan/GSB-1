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
     * @ORM\OneToMany(targetEntity="LigneFf.php", mappedBy="typeFF")
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
    public function getLigneFFs(): Collection
    {
        return $this->ligneFFs;
    }

    public function addLigneFF(LigneFf $ligneFF): self
    {
        if (!$this->ligneFFs->contains($ligneFF)) {
            $this->ligneFFs[] = $ligneFF;
            $ligneFF->setTypeFF($this);
        }

        return $this;
    }

    public function removeLigneFF(LigneFf $ligneFF): self
    {
        if ($this->ligneFFs->contains($ligneFF)) {
            $this->ligneFFs->removeElement($ligneFF);
            // set the owning side to null (unless already changed)
            if ($ligneFF->getTypeFF() === $this) {
                $ligneFF->setTypeFF(null);
            }
        }

        return $this;
    }
}

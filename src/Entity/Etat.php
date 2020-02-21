<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtatRepository")
 */
class Etat
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
    private $ordre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fiche", mappedBy="etat")
     */
    private $fiches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ligneHF", mappedBy="etat")
     */
    private $ligneHF;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ligneFF", mappedBy="etat")
     */
    private $ligneFF;

    public function __construct()
    {
        $this->fiches = new ArrayCollection();
        $this->ligneHF = new ArrayCollection();
        $this->ligneFF = new ArrayCollection();
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

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * @return Collection|Fiche[]
     */
    public function getFiches(): Collection
    {
        return $this->fiches;
    }

    public function addFich(Fiche $fich): self
    {
        if (!$this->fiches->contains($fich)) {
            $this->fiches[] = $fich;
            $fich->setEtat($this);
        }

        return $this;
    }

    public function removeFich(Fiche $fich): self
    {
        if ($this->fiches->contains($fich)) {
            $this->fiches->removeElement($fich);
            // set the owning side to null (unless already changed)
            if ($fich->getEtat() === $this) {
                $fich->setEtat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ligneHF[]
     */
    public function getLigneHF(): Collection
    {
        return $this->ligneHF;
    }

    public function addLigneHF(ligneHF $ligneHF): self
    {
        if (!$this->ligneHF->contains($ligneHF)) {
            $this->ligneHF[] = $ligneHF;
            $ligneHF->setEtat($this);
        }

        return $this;
    }

    public function removeLigneHF(ligneHF $ligneHF): self
    {
        if ($this->ligneHF->contains($ligneHF)) {
            $this->ligneHF->removeElement($ligneHF);
            // set the owning side to null (unless already changed)
            if ($ligneHF->getEtat() === $this) {
                $ligneHF->setEtat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ligneFF[]
     */
    public function getLigneFF(): Collection
    {
        return $this->ligneFF;
    }

    public function addLigneFF(ligneFF $ligneFF): self
    {
        if (!$this->ligneFF->contains($ligneFF)) {
            $this->ligneFF[] = $ligneFF;
            $ligneFF->setEtat($this);
        }

        return $this;
    }

    public function removeLigneFF(ligneFF $ligneFF): self
    {
        if ($this->ligneFF->contains($ligneFF)) {
            $this->ligneFF->removeElement($ligneFF);
            // set the owning side to null (unless already changed)
            if ($ligneFF->getEtat() === $this) {
                $ligneFF->setEtat(null);
            }
        }

        return $this;
    }
}

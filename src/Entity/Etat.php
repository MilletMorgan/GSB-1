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
     * @ORM\OneToMany(targetEntity="App\Entity\LigneHf", mappedBy="etat")
     */
    private $ligneHf;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneFf", mappedBy="etat")
     */
    private $ligneFf;

    public function __construct()
    {
        $this->fiches = new ArrayCollection();
        $this->ligneHf = new ArrayCollection();
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
     * @return Collection|LigneHf[]
     */
    public function getLigneHF(): Collection
    {
        return $this->ligneHf;
    }

    public function addLigneHF(LigneHf $ligneHf): self
    {
        if (!$this->ligneHf->contains($ligneHf)) {
            $this->ligneHf[] = $ligneHf;
            $ligneHf->setEtat($this);
        }

        return $this;
    }

    public function removeLigneHF(LigneHf $ligneHf): self
    {
        if ($this->ligneHf->contains($ligneHf)) {
            $this->ligneHf->removeElement($ligneHf);
            // set the owning side to null (unless already changed)
            if ($ligneHf->getEtat() === $this) {
                $ligneHf->setEtat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LigneFf[]
     */
    public function getLigneFF(): Collection
    {
        return $this->ligneFf;
    }

    public function addLigneFF(LigneFf $ligneFf): self
    {
        if (!$this->ligneFf->contains($ligneFf)) {
            $this->ligneFf[] = $ligneFf;
            $ligneFf->setEtat($this);
        }

        return $this;
    }

    public function removeLigneFF(LigneFf $ligneFf): self
    {
        if ($this->ligneFf->contains($ligneFf)) {
            $this->ligneFf->removeElement($ligneFf);
            // set the owning side to null (unless already changed)
            if ($ligneFf->getEtat() === $this) {
                $ligneFf->setEtat(null);
            }
        }

        return $this;
    }
}

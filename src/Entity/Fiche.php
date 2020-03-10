<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheRepository")
 */
class Fiche
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
    private $mois;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="fiches")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneHf", mappedBy="fiche")
     */
    private $ligneHf;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneFf", mappedBy="fiche")
     */
    private $ligneFf;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fiches")
     */
    private $user;

    public function __construct()
    {
        $this->ligneHf = new ArrayCollection();
        $this->ligneFf = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMois(): ?int
    {
        return $this->mois;
    }

    public function setMois(int $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getEtat(): ?etat
    {
        return $this->etat;
    }

    public function setEtat(?etat $etat): self
    {
        $this->etat = $etat;

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
            $ligneHf->setFiche($this);
        }

        return $this;
    }

    public function removeLigneHF(LigneHf $ligneHf): self
    {
        if ($this->ligneHf->contains($ligneHf)) {
            $this->ligneHf->removeElement($ligneHf);
            // set the owning side to null (unless already changed)
            if ($ligneHf->getFiche() === $this) {
                $ligneHf->setFiche(null);
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
            $ligneFf->setFiche($this);
        }

        return $this;
    }

    public function removeLigneFF(LigneFf $ligneFf): self
    {
        if ($this->ligneFf->contains($ligneFf)) {
            $this->ligneFf->removeElement($ligneFf);
            // set the owning side to null (unless already changed)
            if ($ligneFf->getFiche() === $this) {
                $ligneFf->setFiche(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

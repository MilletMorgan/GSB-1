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
     * @ORM\ManyToOne(targetEntity="App\Entity\etat", inversedBy="fiches")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ligneHF", mappedBy="fiche")
     */
    private $ligneHF;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ligneFF", mappedBy="fiche")
     */
    private $ligneFF;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fiches")
     */
    private $user;

    public function __construct()
    {
        $this->ligneHF = new ArrayCollection();
        $this->ligneFF = new ArrayCollection();
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
            $ligneHF->setFiche($this);
        }

        return $this;
    }

    public function removeLigneHF(ligneHF $ligneHF): self
    {
        if ($this->ligneHF->contains($ligneHF)) {
            $this->ligneHF->removeElement($ligneHF);
            // set the owning side to null (unless already changed)
            if ($ligneHF->getFiche() === $this) {
                $ligneHF->setFiche(null);
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
            $ligneFF->setFiche($this);
        }

        return $this;
    }

    public function removeLigneFF(ligneFF $ligneFF): self
    {
        if ($this->ligneFF->contains($ligneFF)) {
            $this->ligneFF->removeElement($ligneFF);
            // set the owning side to null (unless already changed)
            if ($ligneFF->getFiche() === $this) {
                $ligneFF->setFiche(null);
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

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
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
    private $nomVehicule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="vehicule")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVehicule(): ?string
    {
        return $this->nomVehicule;
    }

    public function setNomVehicule(string $nomVehicule): self
    {
        $this->nomVehicule = $nomVehicule;

        return $this;
    }


    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function __toString(): string
    {
        return $this->utilisateur;
    }
}
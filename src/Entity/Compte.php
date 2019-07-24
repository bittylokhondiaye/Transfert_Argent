<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
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
    private $NumeroCompte;

    /**
     * @ORM\Column(type="text")
     */
    private $NomPropriétaire;

    /**
     * @ORM\Column(type="date")
     */
    private $DateCreation;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\Column(type="integer")
     */
    private $CNIproprietaire;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Partenaire", inversedBy="compte", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Partenaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompte(): ?int
    {
        return $this->NumeroCompte;
    }

    public function setNumeroCompte(int $NumeroCompte): self
    {
        $this->NumeroCompte = $NumeroCompte;

        return $this;
    }

    public function getNomPropriétaire(): ?string
    {
        return $this->NomPropriétaire;
    }

    public function setNomPropriétaire(string $NomPropriétaire): self
    {
        $this->NomPropriétaire = $NomPropriétaire;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeInterface $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

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

    public function getCNIproprietaire(): ?int
    {
        return $this->CNIproprietaire;
    }

    public function setCNIproprietaire(int $CNIproprietaire): self
    {
        $this->CNIproprietaire = $CNIproprietaire;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->Partenaire;
    }

    public function setPartenaire(Partenaire $Partenaire): self
    {
        $this->Partenaire = $Partenaire;

        return $this;
    }
}

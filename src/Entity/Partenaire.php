<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $MotDePasse;


    /**
     * @ORM\Column(type="integer")
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string")
     */
    private $Mail;




    /**
     * @ORM\Column(type="integer")
     */
    private $NumCompteBancaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $linéa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $RaisonSocial;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdminPartenaire", mappedBy="partenaire")
     */
    private $AdminPartenaire;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Compte", mappedBy="Partenaire", cascade={"persist", "remove"})
     */
    private $compte;

    

    public function __construct()
    {
        $this->AdminPartenaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getMotDePasse(): ?string
    {
        return $this->MotDePasse;
    }

    public function setMotDePasse(string $MotDePasse): self
    {
        $this->MotDePasse = $MotDePasse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(int $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }


    public function getNumCompteBancaire(): ?int
    {
        return $this->NumCompteBancaire;
    }

    public function setNumCompteBancaire(int $NumCompteBancaire): self
    {
        $this->NumCompteBancaire = $NumCompteBancaire;

        return $this;
    }

    public function getLinéa(): ?int
    {
        return $this->linéa;
    }

    public function setLinéa(int $linéa): self
    {
        $this->linéa = $linéa;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getRaisonSocial(): ?string
    {
        return $this->RaisonSocial;
    }

    public function setRaisonSocial(string $RaisonSocial): self
    {
        $this->RaisonSocial = $RaisonSocial;

        return $this;
    }

    /**
     * @return Collection|AdminPartenaire[]
     */
    public function getAdminPartenaire(): Collection
    {
        return $this->AdminPartenaire;
    }

    public function addAdminPartenaire(AdminPartenaire $adminPartenaire): self
    {
        if (!$this->AdminPartenaire->contains($adminPartenaire)) {
            $this->AdminPartenaire[] = $adminPartenaire;
            $adminPartenaire->setPartenaire($this);
        }

        return $this;
    }

    public function removeAdminPartenaire(AdminPartenaire $adminPartenaire): self
    {
        if ($this->AdminPartenaire->contains($adminPartenaire)) {
            $this->AdminPartenaire->removeElement($adminPartenaire);
            // set the owning side to null (unless already changed)
            if ($adminPartenaire->getPartenaire() === $this) {
                $adminPartenaire->setPartenaire(null);
            }
        }

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(Compte $compte): self
    {
        $this->compte = $compte;

        // set the owning side of the relation if necessary
        if ($this !== $compte->getPartenaire()) {
            $compte->setPartenaire($this);
        }

        return $this;
    }

    /* public function getSuperAdmin(): ?SuperAdmin
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(?SuperAdmin $superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    } */
}

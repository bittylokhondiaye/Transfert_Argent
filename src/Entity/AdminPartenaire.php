<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AdminPartenaireRepository")
 */
class AdminPartenaire extends UserPartenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserPartenaire")
     */
    private $UserPartenaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="AdminPartenaire")
     */
    private $partenaire;

    public function __construct()
    {
        $this->UserPartenaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    



    /**
     * @return Collection|UserPartenaire[]
     */
    public function getUserPartenaire(): Collection
    {
        return $this->UserPartenaire;
    }

    public function addUserPartenaire(UserPartenaire $userPartenaire): self
    {
        if (!$this->UserPartenaire->contains($userPartenaire)) {
            $this->UserPartenaire[] = $userPartenaire;
        }

        return $this;
    }

    public function removeUserPartenaire(UserPartenaire $userPartenaire): self
    {
        if ($this->UserPartenaire->contains($userPartenaire)) {
            $this->UserPartenaire->removeElement($userPartenaire);
        }

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }
}

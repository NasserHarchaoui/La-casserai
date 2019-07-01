<?php
// src/AppBundle/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $prenom;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $superAdmin;
    /**
     * @ORM\Column(name="giroupy", type="string", nullable=true)
     */
    protected $group;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservering", mappedBy="accountnummer")
     */
    private $reserverings;

    public function __construct()
    {
        parent::__construct();
        $this->superAdmin = false;
        $this->groups = new ArrayCollection();
        // your own logic
        if (empty($this->registerDate)) {
            $this->registerDate = new \DateTime();
        }
        $this->reserverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function setGroup(?string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getSuperAdmin(): ?bool
    {
        return $this->superAdmin;
    }


    public function setSuperAdmin($superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }

    /**
     * @return Collection|Reservering[]
     */
    public function getReserverings(): Collection
    {
        return $this->reserverings;
    }

    public function addReservering(Reservering $reservering): self
    {
        if (!$this->reserverings->contains($reservering)) {
            $this->reserverings[] = $reservering;
            $reservering->setAccountnummer($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->contains($reservering)) {
            $this->reserverings->removeElement($reservering);
            // set the owning side to null (unless already changed)
            if ($reservering->getAccountnummer() === $this) {
                $reservering->setAccountnummer(null);
            }
        }

        return $this;
    }
}
<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReserveringRepository")
 */
class Reservering
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $aankomstdatum;

    /**
     * @ORM\Column(type="date")
     */
    private $vertrekdatum;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kinderen;

    /**
     * @ORM\Column(type="integer")
     */
    private $volwassenen;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reserverings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $accountnummer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Betaling", mappedBy="reservering")
     */
    private $betaalnummer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Kamer", inversedBy="reserverings")
     */
    private $kamernummer;


    public function __construct()
    {
        $this->betaalnummer = new ArrayCollection();
        $this->kamernummer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAankomstdatum(): ?\DateTimeInterface
    {
        return $this->aankomstdatum;
    }

    public function setAankomstdatum(\DateTimeInterface $aankomstdatum): self
    {
        $this->aankomstdatum = $aankomstdatum;

        return $this;
    }

    public function getVertrekdatum(): ?\DateTimeInterface
    {
        return $this->vertrekdatum;
    }

    public function setVertrekdatum(\DateTimeInterface $vertrekdatum): self
    {
        $this->vertrekdatum = $vertrekdatum;

        return $this;
    }

    public function getKinderen(): ?int
    {
        return $this->kinderen;
    }

    public function setKinderen(?int $kinderen): self
    {
        $this->kinderen = $kinderen;

        return $this;
    }

    public function getVolwassenen(): ?int
    {
        return $this->volwassenen;
    }

    public function setVolwassenen(int $volwassenen): self
    {
        $this->volwassenen = $volwassenen;

        return $this;
    }

    public function getAccountnummer(): ?User
    {
        return $this->accountnummer;
    }

    public function setAccountnummer(?User $accountnummer): self
    {
        $this->accountnummer = $accountnummer;

        return $this;
    }

    /**
     * @return Collection|Betaling[]
     */
    public function getBetaalnummer(): Collection
    {
        return $this->betaalnummer;
    }

    public function addBetaalnummer(Betaling $betaalnummer): self
    {
        if (!$this->betaalnummer->contains($betaalnummer)) {
            $this->betaalnummer[] = $betaalnummer;
            $betaalnummer->setReservering($this);
        }

        return $this;
    }

    public function removeBetaalnummer(Betaling $betaalnummer): self
    {
        if ($this->betaalnummer->contains($betaalnummer)) {
            $this->betaalnummer->removeElement($betaalnummer);
            // set the owning side to null (unless already changed)
            if ($betaalnummer->getReservering() === $this) {
                $betaalnummer->setReservering(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Kamer[]
     */
    public function getKamernummer(): Collection
    {
        return $this->kamernummer;
    }

    public function addKamernummer(Kamer $kamernummer): self
    {
        if (!$this->kamernummer->contains($kamernummer)) {
            $this->kamernummer[] = $kamernummer;
        }

        return $this;
    }

    public function removeKamernummer(Kamer $kamernummer): self
    {
        if ($this->kamernummer->contains($kamernummer)) {
            $this->kamernummer->removeElement($kamernummer);
        }

        return $this;
    }
}

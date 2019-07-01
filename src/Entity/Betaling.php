<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BetalingRepository")
 */
class Betaling
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
    private $betaalmethode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reservering", inversedBy="betaalnummer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservering;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBetaalmethode(): ?string
    {
        return $this->betaalmethode;
    }

    public function setBetaalmethode(string $betaalmethode): self
    {
        $this->betaalmethode = $betaalmethode;

        return $this;
    }

    public function getReservering(): ?Reservering
    {
        return $this->reservering;
    }

    public function setReservering(?Reservering $reservering): self
    {
        $this->reservering = $reservering;

        return $this;
    }
}

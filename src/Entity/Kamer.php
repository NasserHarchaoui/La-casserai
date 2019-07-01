<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KamerRepository")
 */
class Kamer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $kamerbeschrijving;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $kamerprijs;

    /**
     * @ORM\Column(type="integer")
     */
    private $personen;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hond;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="details")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reservering", mappedBy="kamernummer")
     */
    private $reserverings;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->reserverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKamerbeschrijving(): ?string
    {
        return $this->kamerbeschrijving;
    }

    public function setKamerbeschrijving(?string $kamerbeschrijving): self
    {
        $this->kamerbeschrijving = $kamerbeschrijving;

        return $this;
    }

    public function getKamerprijs()
    {
        return $this->kamerprijs;
    }

    public function setKamerprijs($kamerprijs): self
    {
        $this->kamerprijs = $kamerprijs;

        return $this;
    }

    public function getPersonen(): ?int
    {
        return $this->personen;
    }

    public function setPersonen(int $personen): self
    {
        $this->personen = $personen;

        return $this;
    }

    public function getHond(): ?int
    {
        return $this->hond;
    }

    public function setHond(?int $hond): self
    {
        $this->hond = $hond;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addDetail($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeDetail($this);
        }

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
            $reservering->addKamernummer($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->contains($reservering)) {
            $this->reserverings->removeElement($reservering);
            $reservering->removeKamernummer($this);
        }

        return $this;
    }
}

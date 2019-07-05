<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsommationRepository")
 */
class Consommation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     */
    private $kw;

    /**
     * @ORM\Column(type="float")
     */
    private $kwh;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getKw(): ?float
    {
        return $this->kw;
    }

    public function setKw(float $kw): self
    {
        $this->kw = $kw;

        return $this;
    }

    public function getKwh(): ?float
    {
        return $this->kwh;
    }

    public function setKwh(float $kwh): self
    {
        $this->kwh = $kwh;

        return $this;
    }
}

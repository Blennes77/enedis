<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RetryRepository")
 */
class Retry
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
    private $lastUpdateEnedis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastUpdateEnedis(): ?\DateTimeInterface
    {
        return $this->lastUpdateEnedis;
    }

    public function setLastUpdateEnedis(\DateTimeInterface $lastUpdateEnedis): self
    {
        $this->lastUpdateEnedis = $lastUpdateEnedis;

        return $this;
    }
}

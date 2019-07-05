<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeteoRepository")
 */
class Meteo
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
    private $temperature;

    /**
     * @ORM\Column(type="float")
     */
    private $pressure;

    /**
     * @ORM\Column(type="float")
     */
    private $temperatureMin;

    /**
     * @ORM\Column(type="float")
     */
    private $temperatureMax;

    /**
     * @ORM\Column(type="float")
     */
    private $humidity;

    /**
     * @ORM\Column(type="float")
     */
    private $windSpeed;

    /**
     * @ORM\Column(type="integer")
     */
    private $windDirection;

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

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getPressure(): ?float
    {
        return $this->pressure;
    }

    public function setPressure(float $pressure): self
    {
        $this->pressure = $pressure;

        return $this;
    }

    public function getTemperatureMin(): ?float
    {
        return $this->temperatureMin;
    }

    public function setTemperatureMin(float $temperatureMin): self
    {
        $this->temperatureMin = $temperatureMin;

        return $this;
    }

    public function getTemperatureMax(): ?float
    {
        return $this->temperatureMax;
    }

    public function setTemperatureMax(float $temperatureMax): self
    {
        $this->temperatureMax = $temperatureMax;

        return $this;
    }

    public function getHumidity(): ?float
    {
        return $this->humidity;
    }

    public function setHumidity(float $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getWindSpeed(): ?float
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(float $windSpeed): self
    {
        $this->windSpeed = $windSpeed;

        return $this;
    }

    public function getWindDirection(): ?int
    {
        return $this->windDirection;
    }

    public function setWindDirection(int $windDirection): self
    {
        $this->windDirection = $windDirection;

        return $this;
    }
}

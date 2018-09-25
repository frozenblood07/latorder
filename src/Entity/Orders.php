<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Orders
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
    private $start_lat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stop_lat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $start_long;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stop_long;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $distance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartLat(): ?string
    {
        return $this->start_lat;
    }

    public function setStartLat(string $start_lat): self
    {
        $this->start_lat = $start_lat;

        return $this;
    }

    public function getStopLat(): ?string
    {
        return $this->stop_lat;
    }

    public function setStopLat(string $stop_lat): self
    {
        $this->stop_lat = $stop_lat;

        return $this;
    }

    public function getStartLong(): ?string
    {
        return $this->start_long;
    }

    public function setStartLong(string $start_long): self
    {
        $this->start_long = $start_long;

        return $this;
    }

    public function getStopLong(): ?string
    {
        return $this->stop_long;
    }

    public function setStopLong(string $stop_long): self
    {
        $this->stop_long = $stop_long;

        return $this;
    }

    public function getDistance(): ?string
    {
        return $this->distance;
    }

    public function setDistance(string $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}

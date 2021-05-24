<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StationRepository::class)
 */
#[ApiResource]
class Station
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="guid")
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $country;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="start_station")
     */
    private $bookings;

    /**
     * @ORM\OneToMany(targetEntity=StationEquipament::class, mappedBy="station", orphanRemoval=true)
     */
    private $stationEquipaments;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->stationEquipaments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setStartStation($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getStartStation() === $this) {
                $booking->setStartStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|StationEquipament[]
     */
    public function getStationEquipaments(): Collection
    {
        return $this->stationEquipaments;
    }

    public function addStationEquipament(StationEquipament $stationEquipament): self
    {
        if (!$this->stationEquipaments->contains($stationEquipament)) {
            $this->stationEquipaments[] = $stationEquipament;
            $stationEquipament->setStation($this);
        }

        return $this;
    }

    public function removeStationEquipament(StationEquipament $stationEquipament): self
    {
        if ($this->stationEquipaments->removeElement($stationEquipament)) {
            // set the owning side to null (unless already changed)
            if ($stationEquipament->getStation() === $this) {
                $stationEquipament->setStation(null);
            }
        }

        return $this;
    }
}

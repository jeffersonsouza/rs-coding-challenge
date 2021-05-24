<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Uid\Uuid;

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
     * @ApiProperty(identifier=false)
     */
    private $id;

    /**
     * @ORM\Column(type="uuid", unique=true)
     * @ApiProperty(identifier=true)
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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="start_station")
     */
    private $bookings;

    /**
     * @ORM\OneToMany(targetEntity=StationEquipment::class, mappedBy="station", orphanRemoval=true)
     */
    private $stationEquipments;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->stationEquipments = new ArrayCollection();
        $this->uuid = Uuid::v4();
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
     * @return Booking[]|Collection
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
     * @return Collection|StationEquipment[]
     */
    public function getStationEquipments(): Collection
    {
        return $this->stationEquipments;
    }

    public function addStationEquipment(StationEquipment $stationEquipment): self
    {
        if (!$this->stationEquipments->contains($stationEquipment)) {
            $this->stationEquipments[] = $stationEquipment;
            $stationEquipment->setStation($this);
        }

        return $this;
    }

    public function removeStationEquipment(StationEquipment $stationEquipment): self
    {
        if ($this->stationEquipments->removeElement($stationEquipment)) {
            // set the owning side to null (unless already changed)
            if ($stationEquipment->getStation() === $this) {
                $stationEquipment->setStation(null);
            }
        }

        return $this;
    }
}

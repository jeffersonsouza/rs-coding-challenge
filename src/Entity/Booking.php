<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
#[ApiResource]
class Booking
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
     * @ORM\ManyToOne(targetEntity=Station::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $start_station;

    /**
     * @ORM\ManyToOne(targetEntity=Station::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $finish_station;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $finish_date;

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
     * @ORM\ManyToOne(targetEntity=Campervan::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campervan;

    /**
     * @ORM\OneToMany(targetEntity=BookingEquipment::class, mappedBy="booking", orphanRemoval=true)
     */
    private $bookingEquipments;

    public function __construct()
    {
        $this->bookingEquipments = new ArrayCollection();
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

    public function getStartStation(): ?Station
    {
        return $this->start_station;
    }

    public function setStartStation(?Station $start_station): self
    {
        $this->start_station = $start_station;

        return $this;
    }

    public function getFinishStation(): ?Station
    {
        return $this->finish_station;
    }

    public function setFinishStation(?Station $finish_station): self
    {
        $this->finish_station = $finish_station;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getFinishDate(): ?\DateTimeInterface
    {
        return $this->finish_date;
    }

    public function setFinishDate(\DateTimeInterface $finish_date): self
    {
        $this->finish_date = $finish_date;

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

    public function getCampervan(): ?Campervan
    {
        return $this->campervan;
    }

    public function setCampervan(?Campervan $campervan): self
    {
        $this->campervan = $campervan;

        return $this;
    }

    /**
     * @return BookingEquipment[]|Collection
     */
    public function getBookingEquipments(): Collection
    {
        return $this->bookingEquipments;
    }

    public function addBookingEquipment(BookingEquipment $bookingEquipment): self
    {
        if (!$this->bookingEquipments->contains($bookingEquipment)) {
            $this->bookingEquipments[] = $bookingEquipment;
            $bookingEquipment->setBooking($this);
        }

        return $this;
    }

    public function removeBookingEquipment(BookingEquipment $bookingEquipment): self
    {
        if ($this->bookingEquipments->removeElement($bookingEquipment)) {
            // set the owning side to null (unless already changed)
            if ($bookingEquipment->getBooking() === $this) {
                $bookingEquipment->setBooking(null);
            }
        }

        return $this;
    }
}

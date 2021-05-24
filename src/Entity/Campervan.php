<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CampervanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=CampervanRepository::class)
 */
#[ApiResource]
class Campervan
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

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
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="campervan")
     */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
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
            $booking->setCampervan($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getCampervan() === $this) {
                $booking->setCampervan(null);
            }
        }

        return $this;
    }
}

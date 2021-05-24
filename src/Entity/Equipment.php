<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
#[ApiResource]
class Equipment
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
     * @ORM\OneToMany(targetEntity=StationEquipment::class, mappedBy="equipment", orphanRemoval=true)
     */
    private $stationEquipments;

    public function __construct()
    {
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
            $stationEquipment->setEquipment($this);
        }

        return $this;
    }

    public function removeStationEquipment(StationEquipment $stationEquipment): self
    {
        if ($this->stationEquipments->removeElement($stationEquipment)) {
            // set the owning side to null (unless already changed)
            if ($stationEquipment->getEquipment() === $this) {
                $stationEquipment->setEquipment(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $id;

    /**
     * @ORM\Column(type="guid")
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=StationEquipament::class, mappedBy="equipment", orphanRemoval=true)
     */
    private $stationEquipaments;

    public function __construct()
    {
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
            $stationEquipament->setEquipment($this);
        }

        return $this;
    }

    public function removeStationEquipament(StationEquipament $stationEquipament): self
    {
        if ($this->stationEquipaments->removeElement($stationEquipament)) {
            // set the owning side to null (unless already changed)
            if ($stationEquipament->getEquipment() === $this) {
                $stationEquipament->setEquipment(null);
            }
        }

        return $this;
    }
}

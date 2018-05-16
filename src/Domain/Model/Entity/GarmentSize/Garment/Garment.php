<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository")
 * @ORM\Table(name="garment")
 */
class Garment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType", inversedBy="garment_types")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garmentType;

    /**
     * @ORM\OneToMany(targetEntity="Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize", mappedBy="garment")
     */
    private $garmentSizes;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getGarmentType(): GarmentType
    {
        return $this->garmentType;
    }

    public function setGarmentType(GarmentType $garmentType): void
    {
        $this->garmentType = $garmentType;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

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
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return GarmentType
     */
    public function getGarmentType(): GarmentType
    {
        return $this->garmentType;
    }

    /**
     * @param mixed $garmentType
     */
    public function setGarmentType($garmentType): void
    {
        $this->garmentType = $garmentType;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


}

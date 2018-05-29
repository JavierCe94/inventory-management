<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository")
 * @ORM\Table(name="garment_type")
 */
class GarmentType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @ORM\OneToMany(
     * targetEntity="Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size",
     * mappedBy="garmentType")
     */
    protected $sizes;

    public function __construct()
    {
        $this->sizes = new ArrayCollection();
    }

    public function getSizes()
    {
        return $this->sizes;
    }
}

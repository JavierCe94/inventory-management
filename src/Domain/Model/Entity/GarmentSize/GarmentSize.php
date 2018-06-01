<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

use Doctrine\ORM\Mapping as ORM;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\GarmentSize\GarmentSizeRepository")
 * @ORM\Table(name="garment_size")
 */
class GarmentSize
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment", inversedBy="garmentSizes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garment;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size", inversedBy="garmentSizes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $size;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default"=0})
     */
    private $stock;

    private function __construct(Size $size, Garment $garment)
    {
        $this->size = $size;
        $this->garment = $garment;
        $this->stock = 0;
    }

    public static function createFromApi(Size $size, Garment $garment): GarmentSize
    {
        return new self($size, $garment);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGarment(): Garment
    {
        return $this->garment;
    }

    public function setGarment(Garment $garment): void
    {
        $this->garment = $garment;
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function setSize(Size $size): void
    {
        $this->size = $size;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }
}

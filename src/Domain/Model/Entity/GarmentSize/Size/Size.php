<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\GarmentSize\Size\SizeRepository")
 * @ORM\Table(name="size")
 */
class Size
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeType", inversedBy="sizes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sizeType;

    /**
     * @ORM\Column(type="string", length=3, nullable=false)
     */
    private $sizeValue;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSizeType(): SizeType
    {
        return $this->sizeType;
    }

    public function setSizeType(SizeType $sizeType): void
    {
        $this->sizeType = $sizeType;
    }

    public function getSizeValue(): string
    {
        return $this->sizeValue;
    }

    public function setSizeValue(string $sizeValue): void
    {
        $this->sizeValue = $sizeValue;
    }
}

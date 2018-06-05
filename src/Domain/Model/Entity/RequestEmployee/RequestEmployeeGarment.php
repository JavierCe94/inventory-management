<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Doctrine\ORM\Mapping as ORM;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\RequestEmployee\RequestEmployeeGarmentRepository")
 * @ORM\Table(name="request_employee_garment")
 */
class RequestEmployeeGarment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployee")
     * @ORM\JoinColumn(nullable=false)
     */
    private $requestEmployee;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garmentSize;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isDeleted;

    public function __construct(RequestEmployee $requestEmployee, GarmentSize $garmentSize)
    {
        $this->requestEmployee = $requestEmployee;
        $this->garmentSize = $garmentSize;
        $this->isDeleted = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRequestEmployee(): RequestEmployee
    {
        return $this->requestEmployee;
    }

    public function getGarmentSize(): GarmentSize
    {
        return $this->garmentSize;
    }

    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }
}

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
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployee", inversedBy="request_employees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $requestEmployee;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize", inversedBy="garment_sizes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garmentSize;

    public function getId(): int
    {
        return $this->id;
    }

    public function getRequestEmployee(): RequestEmployee
    {
        return $this->requestEmployee;
    }

    public function setRequestEmployee(RequestEmployee $requestEmployee): void
    {
        $this->requestEmployee = $requestEmployee;
    }

    public function getGarmentSize(): GarmentSize
    {
        return $this->garmentSize;
    }

    public function setGarmentSize(GarmentSize $garmentSize): void
    {
        $this->garmentSize = $garmentSize;
    }
}

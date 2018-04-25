<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Doctrine\ORM\Mapping as ORM;
use Inventory\Management\Domain\Model\Entity\Employee\Employee;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\RequestEmployee\RequestEmployeeRepository")
 * @ORM\Table(name="request_employee")
 */
class RequestEmployee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $employee;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true, options={"default"=null})
     */
    private $dateModification;

    /**
     * @ORM\Column(type="string", length=50, nullable=false, options={"default"="DRAFT"})
     */
    private $status;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): void
    {
        $this->employee = $employee;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    public function getDateModification(): string
    {
        return $this->dateModification;
    }

    public function setDateModification(string $dateModification): void
    {
        $this->dateModification = $dateModification;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}

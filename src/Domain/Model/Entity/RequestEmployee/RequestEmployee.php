<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Doctrine\ORM\Mapping as ORM;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function setEmployee($employee): void
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
}

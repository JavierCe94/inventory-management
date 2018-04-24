<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\Employee\EmployeeRepository")
 * @ORM\Table(name="employee")
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="Inventory\Management\Domain\Model\Entity\Employee\EmployeeStatus")
     */
    private $employeeStatus;
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $image;
    /**
     * @ORM\Column(type="string", length=9, nullable=false, unique=true, options={"default"="-"})
     */
    private $nif;
    /**
     * @ORM\Column(type="string", length=50, nullable=false, options={"default"="-"})
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=30, nullable=false, unique=true, options={"default"="-"})
     */
    private $inSsNumber;
    /**
     * @ORM\Column(type="string", length=12, nullable=false, unique=true, options={"default"="-"})
     */
    private $telephone;

    public function getId()
    {
        return $this->id;
    }

    public function getEmployeeStatus()
    {
        return $this->employeeStatus;
    }

    public function setEmployeeStatus($employeeStatus): void
    {
        $this->employeeStatus = $employeeStatus;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getNif()
    {
        return $this->nif;
    }

    public function setNif($nif): void
    {
        $this->nif = $nif;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getInSsNumber()
    {
        return $this->inSsNumber;
    }

    public function setInSsNumber($inSsNumber): void
    {
        $this->inSsNumber = $inSsNumber;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }
}

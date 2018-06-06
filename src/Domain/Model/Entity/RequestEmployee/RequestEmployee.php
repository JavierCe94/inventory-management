<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Inventory\Management\Domain\Model\Entity\Employee\Employee;

/**
 * @ORM\Entity(
 *     repositoryClass="Inventory\Management\Infrastructure\Repository\RequestEmployee\RequestEmployeeRepository"
 * )
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
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\Employee\Employee")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @ORM\OneToMany(targetEntity="Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarment", mappedBy="requestEmployee")
     */
    private $requestEmployeeGarment;

    /**
     * @ORM\OneToOne(targetEntity="Inventory\Management\Domain\Model\Entity\RequestEmployee\Firm")
     */
    private $firm;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateModification;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $status;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
        $this->dateCreation = new \DateTime();
        $this->dateModification = new \DateTime();
        $this->status = RequestEmployeeStatus::STATUS_DRAFT;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    /**
     * @return Collection|RequestEmployeeGarment[]
     */
    public function getRequestEmployeeGarment(): Collection
    {
        return $this->requestEmployeeGarment;
    }

    public function getFirm()
    {
        return $this->firm;
    }

    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    public function getDateModification(): \DateTime
    {
        return $this->dateModification;
    }

    public function setDateModification(\DateTime $dateModification): void
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

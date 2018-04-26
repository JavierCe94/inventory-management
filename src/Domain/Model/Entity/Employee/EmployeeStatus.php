<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Inventory\Management\Infrastructure\Repository\Employee\EmployeeStatusRepository")
 * @ORM\Table(name="employee_status")
 */
class EmployeeStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;
    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default"="00/00/00"})
     */
    private $firstContractDate;
    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default"="00/00/00"})
     */
    private $seniorityDate;
    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default"="00/00/00"})
     */
    private $expirationContractDate;
    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default"="00/00/00"})
     */
    private $possibleRenewal;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default"= 0})
     */
<<<<<<< HEAD
    private $availableHoliDays;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default"= 0})
     */
    private $holiDaysPendingToApplyFor;
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default"= 0})
     */
    private $disabledEmployee;
=======
    private $availableHolidays;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default"= 0})
     */
    private $holidaysPendingToApplyFor;
>>>>>>> 266d76ff7d7ae4b4f7620f54be82032e40c93958
    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\Employee\Department")
     */
    private $department;
    /**
     * @ORM\ManyToOne(targetEntity="Inventory\Management\Domain\Model\Entity\Employee\SubDepartment")
     */
    private $subDepartment;

    public function getId()
    {
        return $this->id;
    }

    public function getFirstContractDate()
    {
        return $this->firstContractDate;
    }

    public function setFirstContractDate($firstContractDate): void
    {
        $this->firstContractDate = $firstContractDate;
    }

    public function getSeniorityDate()
    {
        return $this->seniorityDate;
    }

    public function setSeniorityDate($seniorityDate): void
    {
        $this->seniorityDate = $seniorityDate;
    }

    public function getExpirationContractDate()
    {
        return $this->expirationContractDate;
    }

    public function setExpirationContractDate($expirationContractDate): void
    {
        $this->expirationContractDate = $expirationContractDate;
    }

    public function getPossibleRenewal()
    {
        return $this->possibleRenewal;
    }

    public function setPossibleRenewal($possibleRenewal): void
    {
        $this->possibleRenewal = $possibleRenewal;
    }

<<<<<<< HEAD
    public function getAvailableHoliDays()
    {
        return $this->availableHoliDays;
    }

    public function setAvailableHoliDays($availableHoliDays): void
    {
        $this->availableHoliDays = $availableHoliDays;
    }

    public function getHoliDaysPendingToApplyFor()
    {
        return $this->holiDaysPendingToApplyFor;
    }

    public function setHoliDaysPendingToApplyFor($holiDaysPendingToApplyFor): void
    {
        $this->holiDaysPendingToApplyFor = $holiDaysPendingToApplyFor;
    }

    public function getDisabledEmployee()
    {
        return $this->disabledEmployee;
    }

    public function setDisabledEmployee($disabledEmployee): void
    {
        $this->disabledEmployee = $disabledEmployee;
=======
    public function getAvailableHolidays()
    {
        return $this->availableHolidays;
    }

    public function setAvailableHolidays($availableHolidays): void
    {
        $this->availableHolidays = $availableHolidays;
    }

    public function getHolidaysPendingToApplyFor()
    {
        return $this->holidaysPendingToApplyFor;
    }

    public function setHolidaysPendingToApplyFor($holidaysPendingToApplyFor): void
    {
        $this->holidaysPendingToApplyFor = $holidaysPendingToApplyFor;
>>>>>>> 266d76ff7d7ae4b4f7620f54be82032e40c93958
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment($department): void
    {
        $this->department = $department;
    }

    public function getSubDepartment()
    {
        return $this->subDepartment;
    }

    public function setSubDepartment($subDepartment): void
    {
        $this->subDepartment = $subDepartment;
    }
}

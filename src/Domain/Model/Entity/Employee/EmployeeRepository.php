<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

use Inventory\Management\Application\Employee\UpdateBasicFieldsEmployee\UpdateBasicFieldsEmployeeCommand;
use Inventory\Management\Application\Employee\UpdateFieldsEmployeeStatus\UpdateFieldsEmployeeStatusCommand;
use Inventory\Management\Domain\Model\Entity\Department\Department;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartment;

interface EmployeeRepository
{
    public function createEmployee(Employee $employee): Employee;
    public function changeStatusEmployee(Employee $employee, bool $isDisabled): Employee;
    public function updateBasicFieldsEmployee(
        Employee $employee,
        string $passwordHash,
        string $name,
        string $telephone
    ): Employee;
    public function updateFieldsEmployeeStatus(
        Employee $employee,
        string $image,
        \DateTime $expirationContractDate,
        \DateTime $possibleRenewal,
        int $availableHolidays,
        int $holidaysPendingToApplyFor,
        Department $department,
        SubDepartment $subDepartment
    ): Employee;
    public function findEmployeeByNif(string $nif): ?Employee;
    public function showByFirstResultFilterEmployees(
        int $initialResult,
        $name,
        $code,
        $department,
        $subDepartment
    ): array;
    public function checkNotExistsInSsNumberEmployee(string $inSsNumber): ?Employee;
    public function checkNotExistsTelephoneEmployee(string $telephone, string $nif): ?Employee;
}

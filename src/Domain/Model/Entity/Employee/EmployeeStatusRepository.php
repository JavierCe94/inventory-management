<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

interface EmployeeStatusRepository
{
    public function createEmployeeStatus(EmployeeStatus $employeeStatus): EmployeeStatus;
    public function checkNotExistsCodeEmployeeStatus(string $codeEmployee): ?EmployeeStatus;
}

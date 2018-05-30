<?php

namespace Inventory\Management\Domain\Model\Entity\Department;

interface DepartmentRepository
{
    public function createDepartment(Department $department): Department;
    public function updateNameDepartment(Department $department, string $name): Department;
    public function findDepartmentById(int $idDepartment): ?Department;
    public function showAllDepartments(): array;
    public function checkNotExistNameDepartment($name): ?Department;
}

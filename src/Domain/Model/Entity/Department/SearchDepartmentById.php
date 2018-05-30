<?php

namespace Inventory\Management\Domain\Model\Entity\Department;

interface SearchDepartmentById
{
    public function execute(int $department): ?Department;
}

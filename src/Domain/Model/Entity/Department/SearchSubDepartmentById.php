<?php

namespace Inventory\Management\Domain\Model\Entity\Department;

interface SearchSubDepartmentById
{
    public function execute(int $subDepartment): ?SubDepartment;
}

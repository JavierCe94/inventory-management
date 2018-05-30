<?php

namespace Inventory\Management\Domain\Model\Entity\Department;

interface CheckNotExistNameSubDepartment
{
    public function execute(string $name): void;
}

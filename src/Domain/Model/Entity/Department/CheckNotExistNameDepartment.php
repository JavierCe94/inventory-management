<?php

namespace Inventory\Management\Domain\Model\Entity\Department;

interface CheckNotExistNameDepartment
{
    public function execute(string $name): void;
}

<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

interface SearchEmployeeByNif
{
    public function execute(string $nifEmployee): ?Employee;
}

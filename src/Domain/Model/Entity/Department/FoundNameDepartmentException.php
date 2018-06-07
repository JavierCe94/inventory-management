<?php

namespace Inventory\Management\Domain\Model\Entity\Department;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class FoundNameDepartmentException extends ConflictSearchException
{
    public function message(): string
    {
        return 'El departamento ya existe';
    }
}

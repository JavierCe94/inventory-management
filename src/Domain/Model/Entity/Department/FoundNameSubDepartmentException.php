<?php

namespace Inventory\Management\Domain\Model\Entity\Department;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class FoundNameSubDepartmentException extends ConflictSearchException
{
    public function message(): string
    {
        return 'El subdepartamento ya existe';
    }
}

<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class FoundNifEmployeeException extends ConflictSearchException
{
    public function message(): string
    {
        return 'El NIF introducido ya existe';
    }
}

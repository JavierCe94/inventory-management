<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class FoundTelephoneEmployeeException extends ConflictSearchException
{
    public function message(): string
    {
        return 'El teléfono introducido ya existe';
    }
}

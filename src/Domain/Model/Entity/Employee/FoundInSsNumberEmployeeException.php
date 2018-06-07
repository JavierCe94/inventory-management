<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class FoundInSsNumberEmployeeException extends ConflictSearchException
{
    public function message(): string
    {
        return 'El número de la seguridad social introducido ya existe';
    }
}

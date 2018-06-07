<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class FoundCodeEmployeeStatusException extends ConflictSearchException
{
    public function message(): string
    {
        return 'El código de trabajador introducido ya existe';
    }
}

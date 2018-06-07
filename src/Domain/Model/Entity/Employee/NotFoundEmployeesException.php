<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class NotFoundEmployeesException extends NotFoundException
{
    public function message(): string
    {
        return 'No se ha encontrado ningún trabajador';
    }
}

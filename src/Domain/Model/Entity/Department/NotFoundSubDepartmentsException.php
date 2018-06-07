<?php

namespace Inventory\Management\Domain\Model\Entity\Department;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class NotFoundSubDepartmentsException extends NotFoundException
{
    public function message(): string
    {
        return 'No se ha encontrado ningún subdepartamento';
    }
}

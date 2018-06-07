<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class NotFoundRequestEmployeeGarmentsException extends NotFoundException
{
    public function message(): string
    {
        return 'No se ha encontrado ninguna solicitud de prenda';
    }
}

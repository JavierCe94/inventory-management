<?php

namespace Inventory\Management\Domain\Model\Entity\Admin;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class NotFoundAdminsException extends NotFoundException
{
    public function message(): string
    {
        return 'No se ha encontrado ningún administrador';
    }
}

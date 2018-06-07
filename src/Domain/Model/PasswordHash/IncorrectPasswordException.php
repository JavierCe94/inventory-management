<?php

namespace Inventory\Management\Domain\Model\PasswordHash;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class IncorrectPasswordException extends NotFoundException
{
    public function message(): string
    {
        return 'La contraseña introducida no es correcta';
    }
}

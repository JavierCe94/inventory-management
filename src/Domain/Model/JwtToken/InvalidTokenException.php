<?php

namespace Inventory\Management\Domain\Model\JwtToken;

use Inventory\Management\Domain\Model\Exception\UnauthorizedException;

class InvalidTokenException extends UnauthorizedException
{
    public function message(): string
    {
        return 'No se ha iniciado una sesión';
    }
}

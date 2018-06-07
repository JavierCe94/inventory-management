<?php

namespace Inventory\Management\Domain\Model\JwtToken;

use Inventory\Management\Domain\Model\Exception\UnauthorizedException;

class InvalidUserTokenException extends UnauthorizedException
{
    public function message(): string
    {
        return 'El usuario al que intentas acceder no es tuyo';
    }
}

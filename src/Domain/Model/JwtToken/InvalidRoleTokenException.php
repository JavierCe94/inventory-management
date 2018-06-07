<?php

namespace Inventory\Management\Domain\Model\JwtToken;

use Inventory\Management\Domain\Model\Exception\UnauthorizedException;

class InvalidRoleTokenException extends UnauthorizedException
{
    public function message(): string
    {
        return 'No puedes acceder a esta información';
    }
}

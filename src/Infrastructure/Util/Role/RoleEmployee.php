<?php

namespace Inventory\Management\Infrastructure\Util\Role;

use Inventory\Management\Domain\Model\JwtToken\Roles;

class RoleEmployee extends Role
{
    public function roles(): array
    {
        return [Roles::ROLE_EMPLOYEE];
    }
}

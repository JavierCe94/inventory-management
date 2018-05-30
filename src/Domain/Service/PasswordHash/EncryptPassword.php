<?php

namespace Inventory\Management\Domain\Service\PasswordHash;

use Inventory\Management\Domain\Model\PasswordHash\EncryptPassword as EncryptPasswordI;

class EncryptPassword implements EncryptPasswordI
{
    public function execute(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

<?php

namespace Inventory\Management\Domain\Model\PasswordHash;

interface CheckDecryptPassword
{
    public function execute(string $password, string $passwordEncrypted): void;
}

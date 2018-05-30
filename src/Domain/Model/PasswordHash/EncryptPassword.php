<?php

namespace Inventory\Management\Domain\Model\PasswordHash;

interface EncryptPassword
{
    public function execute(string $password): string;
}

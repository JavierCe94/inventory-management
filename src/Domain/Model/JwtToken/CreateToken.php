<?php

namespace Inventory\Management\Domain\Model\JwtToken;

interface CreateToken
{
    public function execute(string $role, array $data): string;
}

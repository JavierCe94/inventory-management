<?php

namespace Inventory\Management\Domain\Model\JwtToken;

interface JwtTokenClass
{
    public function createToken(string $role, array $data): string;
    public function checkToken(array $roles): object;
}

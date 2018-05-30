<?php

namespace Inventory\Management\Domain\Service\JwtToken;

use Inventory\Management\Domain\Model\JwtToken\JwtTokenClass;

class CreateToken
{
    private $jwtTokenClass;

    public function __construct(JwtTokenClass $jwtTokenClass)
    {
        $this->jwtTokenClass = $jwtTokenClass;
    }

    public function execute(string $role, array $data): string
    {
        return $this->jwtTokenClass->createToken($role, $data);
    }
}

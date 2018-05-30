<?php

namespace Inventory\Management\Domain\Service\JwtToken;

use Inventory\Management\Domain\Model\JwtToken\JwtTokenClass;

class CheckToken
{
    private $jwtTokenClass;

    public function __construct(JwtTokenClass $jwtTokenClass)
    {
        $this->jwtTokenClass = $jwtTokenClass;
    }
    
    public function execute(array $roles)
    {
        return $this->jwtTokenClass->checkToken($roles);
    }
}

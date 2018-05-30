<?php

namespace Inventory\Management\Domain\Service\JwtToken;

use Inventory\Management\Domain\Model\JwtToken\JwtTokenClass;
use Inventory\Management\Domain\Model\JwtToken\CheckToken as CheckTokenI;

class CheckToken implements CheckTokenI
{
    private $jwtTokenClass;

    public function __construct(JwtTokenClass $jwtTokenClass)
    {
        $this->jwtTokenClass = $jwtTokenClass;
    }
    
    public function execute(array $roles): object
    {
        return $this->jwtTokenClass->checkToken($roles);
    }
}

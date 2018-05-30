<?php

namespace Inventory\Management\Domain\Model\JwtToken;

interface CheckToken
{
    public function execute(array $roles): object;
}

<?php

namespace Inventory\Management\Application\Employee\CheckLoginEmployee;

class CheckLoginEmployeeTransform implements CheckLoginEmployeeTransformI
{
    public function transform($token)
    {
        return $token;
    }
}

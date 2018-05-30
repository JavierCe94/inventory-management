<?php

namespace Inventory\Management\Application\Admin\CheckLoginAdmin;

class CheckLoginAdminTransform implements CheckLoginAdminTransformI
{
    public function transform($token)
    {
        return $token;
    }
}

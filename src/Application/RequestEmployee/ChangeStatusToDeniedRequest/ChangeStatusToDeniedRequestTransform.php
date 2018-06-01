<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeniedRequest;

class ChangeStatusToDeniedRequestTransform implements ChangeStatusToDeniedRequestTransformI
{
    public function transform()
    {
        return 'Se ha denegado la solicitud con éxito';
    }
}

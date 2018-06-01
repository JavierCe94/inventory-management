<?php

namespace Inventory\Management\Application\RequestEmployee\CreateRequestEmployee;

class CreateRequestEmployeeTransform implements CreateRequestEmployeeTransformI
{
    public function transform()
    {
        return 'Se ha creado la solicitud de prendas con éxito';
    }
}

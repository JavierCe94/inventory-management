<?php

namespace Inventory\Management\Application\Employee\CreateEmployee;

class CreateEmployeeTransform implements CreateEmployeeTransformI
{
    public function transform()
    {
        return 'Se ha creado el trabajador con éxito';
    }
}

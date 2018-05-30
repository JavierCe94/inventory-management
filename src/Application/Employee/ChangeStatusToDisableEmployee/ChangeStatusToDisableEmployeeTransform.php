<?php

namespace Inventory\Management\Application\Employee\ChangeStatusToDisableEmployee;

class ChangeStatusToDisableEmployeeTransform implements ChangeStatusToDisableEmployeeTransformI
{
    public function transform()
    {
        return 'Se ha deshabilitado el trabajador con éxito';
    }
}

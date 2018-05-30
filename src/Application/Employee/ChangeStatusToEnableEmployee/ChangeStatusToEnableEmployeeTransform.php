<?php

namespace Inventory\Management\Application\Employee\ChangeStatusToEnableEmployee;

class ChangeStatusToEnableEmployeeTransform implements ChangeStatusToEnableEmployeeTransformI
{
    public function transform()
    {
        return 'Se ha habilitado el trabajador con éxito';
    }
}

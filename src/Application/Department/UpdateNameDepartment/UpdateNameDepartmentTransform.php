<?php

namespace Inventory\Management\Application\Department\UpdateNameDepartment;

class UpdateNameDepartmentTransform implements UpdateNameDepartmentTransformI
{
    public function transform()
    {
        return 'Se ha actualizado el nombre del departamento con éxito';
    }
}

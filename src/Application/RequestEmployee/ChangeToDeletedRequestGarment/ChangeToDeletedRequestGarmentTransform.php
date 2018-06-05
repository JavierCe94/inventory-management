<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeToDeletedRequestGarment;

class ChangeToDeletedRequestGarmentTransform implements ChangeToDeletedRequestGarmentTransformI
{
    public function transform()
    {
        return 'Se ha eliminado la prenda, para esta solicitud';
    }
}

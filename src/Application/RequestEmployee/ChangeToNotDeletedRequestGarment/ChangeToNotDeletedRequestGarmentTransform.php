<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeToNotDeletedRequestGarment;

class ChangeToNotDeletedRequestGarmentTransform implements ChangeToNotDeletedRequestGarmentTransformI
{
    public function transform()
    {
        return 'Se ha recuperado la prenda, para esta solicitud';
    }
}

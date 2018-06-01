<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeletedRequest;

class ChangeStatusToDeletedRequestTransform implements ChangeStatusToDeletedRequestTransformI
{
    public function transform()
    {
        return 'Se ha eliminado la solicitud con éxito';
    }
}

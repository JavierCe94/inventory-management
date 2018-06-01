<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToAcceptedRequest;

class ChangeStatusToAcceptedRequestTransform implements ChangeStatusToAcceptedRequestTransformI
{
    public function transform()
    {
        return 'Se ha aceptado la solicitud con éxito';
    }
}

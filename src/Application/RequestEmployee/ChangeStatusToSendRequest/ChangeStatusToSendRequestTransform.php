<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToSendRequest;

class ChangeStatusToSendRequestTransform implements ChangeStatusToSendRequestTransformI
{
    public function transform()
    {
        return 'Se ha enviado la solicitud con éxito';
    }
}

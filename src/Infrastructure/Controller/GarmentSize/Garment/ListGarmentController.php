<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarment;
use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarmentCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListGarmentController extends RoleEmployee
{
    public function listGarment(ListGarment $listGarment)
    {
        return new JsonResponse(
            $listGarment->handle(
                new ListGarmentCommand()
            ),
            HttpResponses::OK
        );
    }
}

<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarment;
use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarmentCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListGarmentController extends RoleAdmin
{
    public function __invoke(ListGarment $listGarment)
    {
        return new JsonResponse(
            $listGarment->handle(
                new ListGarmentCommand()
            ),
            HttpResponses::OK
        );
    }
}

<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypes;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypesCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListGarmentTypesController extends RoleAdmin
{
    public function listGarmentTypes(ListGarmentTypes $listGarmentTypes)
    {
        return new JsonResponse(
            $listGarmentTypes->handle(
                new ListGarmentTypesCommand()
            ),
            HttpResponses::OK
        );
    }
}

<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSize;
use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdminEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListGarmentSizeController extends RoleAdminEmployee
{
    public function __invoke(ListGarmentSize $listGarmentSize)
    {
        return new JsonResponse(
            $listGarmentSize->handle(
                new ListGarmentSizeCommand()
            ),
            HttpResponses::OK
        );
    }
}

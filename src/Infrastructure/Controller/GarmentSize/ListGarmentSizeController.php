<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSize;
use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListGarmentSizeController extends RoleEmployee
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

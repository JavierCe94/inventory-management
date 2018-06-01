<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSize;
use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListAllSizeController extends RoleAdmin
{
    public function __invoke(ListAllSize $listAllSize)
    {
        return new JsonResponse(
            $listAllSize->handle(
                new ListAllSizeCommand()
            ),
            HttpResponses::OK
        );
    }
}

<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTable;
use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTableCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GarmentSizeTableController extends RoleAdmin
{
    public function __invoke(Request $request, CreateGarmentSizeTable $handler)
    {
        return new JsonResponse(
            $handler->handle(
                new CreateGarmentSizeTableCommand(
                    $request->request->get("idGarment"),
                    $request->request->get("idSize"),
                    $request->request->get("sizeValue")
                )
            ),
            HttpResponses::OK
        );
    }
}

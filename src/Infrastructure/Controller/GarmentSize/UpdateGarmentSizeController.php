<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSize;
use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateGarmentSizeController extends RoleAdmin
{
    public function __invoke(Request $request, UpdateGarmentSize $handler)
    {
        return new JsonResponse(
            $handler->handle(
                new UpdateGarmentSizeCommand(
                    $request->request->get("idGarment"),
                    $request->request->get("idSize"),
                    $request->request->get("sizeValue"),
                    $request->request->get("stock")
                )
            ),
            HttpResponses::OK
        );
    }
}

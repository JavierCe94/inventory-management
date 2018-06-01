<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarment;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InsertGarmentController extends RoleAdmin
{
    public function insertGarment(
        Request $request,
        InsertGarment $insertGarment
    ) {
        return new JsonResponse(
            $insertGarment->handle(
                new InsertGarmentCommand(
                    $request->request->get('name'),
                    $request->request->get('garmentTypeId')
                )
            ),
            HttpResponses::OK
        );
    }
}

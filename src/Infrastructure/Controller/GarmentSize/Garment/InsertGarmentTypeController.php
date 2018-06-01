<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Service\ReactRequestTransform\ReactRequestTransform;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InsertGarmentTypeController extends RoleAdmin
{
    public function insertGarmentType(
        Request $request,
        InsertGarmentType $insertGarmentType
    ) {
        return new JsonResponse(
            $insertGarmentType->handle(
                new InsertGarmentTypeCommand(
                    $request->request->get('name')
                )
            ),
            HttpResponses::OK
        );
    }
}

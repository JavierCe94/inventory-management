<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateGarmentTypeController extends RoleAdmin
{
    public function updateGarmentType(
        Request $request,
        UpdateGarmentType $updateGarmentType
    ) {
        return new JsonResponse(
            $updateGarmentType->handle(
                new UpdateGarmentTypeCommand(
                    $request->request->get('id'),
                    $request->request->get('name')
                )
            ),
            HttpResponses::OK
        );
    }
}

<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Service\ReactRequestTransform\ReactRequestTransform;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InsertGarmentTypeController extends RoleAdmin
{
    public function insertGarmentType(
        Request $request,
        InsertGarmentType $insertGarmentType
    ) {
        $output = $insertGarmentType->handle(new InsertGarmentTypeCommand(
            $request->request->get('name')
        ));

        return new JsonResponse($output, HttpResponses::OK);
    }
}
<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarment;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Service\ReactRequestTransform\ReactRequestTransform;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateGarmentController extends RoleAdmin
{
    public function updateGarment(
        Request $request,
        UpdateGarment $updateGarment
    ) {
        $output = $updateGarment->handle(new UpdateGarmentCommand(
            $request->request->get('id'),
            $request->request->get('name')
        ));

        return new JsonResponse($output, HttpResponses::OK);
    }
}
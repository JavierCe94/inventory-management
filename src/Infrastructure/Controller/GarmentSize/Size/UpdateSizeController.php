<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSize;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateSizeController extends RoleAdmin
{
    public function __invoke(Request $request, UpdateSize $updateSize)
    {
        return new JsonResponse(
            $updateSize->handle(
                new UpdateSizeCommand(
                    $request->request->get('sizeValue'),
                    $request->request->get('garmentType'),
                    $request->request->get('newSizeValue')
                )
            ),
            HttpResponses::OK
        );
    }
}

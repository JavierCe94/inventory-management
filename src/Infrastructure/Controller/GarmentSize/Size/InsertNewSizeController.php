<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSize;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InsertNewSizeController extends RoleAdmin
{
    public function __invoke(Request $request, InsertNewSize $insertNewSize)
    {
        return new JsonResponse(
            $insertNewSize->handle(
                new InsertNewSizeCommand(
                    $request->request->get('sizeValue'),
                    $request->request->get('garmentType')
                )
            ),
            HttpResponses::OK
        );
    }
}

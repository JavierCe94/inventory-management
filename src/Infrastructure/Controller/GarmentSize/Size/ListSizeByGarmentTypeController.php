<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentType;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListSizeByGarmentTypeController extends RoleAdmin
{
    public function __invoke(Request $request, ListSizeByGarmentType $listSizeByGarmentType)
    {
        return new JsonResponse(
            $listSizeByGarmentType->handle(
                new ListSizeByGarmentTypeCommand(
                    $request->request->get('garmentType')
                )
            ),
            HttpResponses::OK
        );
    }
}

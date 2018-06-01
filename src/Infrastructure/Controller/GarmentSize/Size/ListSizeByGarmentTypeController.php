<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentType;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListSizeByGarmentTypeController extends RoleEmployee
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

<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypes;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypesCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;

class ListGarmentTypesController extends RoleEmployee
{
    public function listGarmentTypes(ListGarmentTypes $listGarmentTypes)
    {
        $queryOutput = $listGarmentTypes->handle(new ListGarmentTypesCommand());
        return $this->json($queryOutput, HttpResponses::OK);
    }
}

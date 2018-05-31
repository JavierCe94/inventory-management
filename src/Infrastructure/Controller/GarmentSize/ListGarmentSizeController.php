<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSize;
use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListGarmentSizeController extends RoleEmployee
{
    private $listGarmentSize;
    public function __construct(ListGarmentSize $listGarmentSize)
    {
        parent::__construct();
        $this->listGarmentSize = $listGarmentSize;
    }

    public function listGarmentSize()
    {
        return new JsonResponse(
            $this->listGarmentSize->handle(
                new ListGarmentSizeCommand()
            ),
            HttpResponses::OK
        );
    }
}

<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSize;
use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSizeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListGarmentSizeController
{
    private $listGarmentSize;
    public function __construct(ListGarmentSize $listGarmentSize)
    {
        $this->listGarmentSize = $listGarmentSize;
    }

    public function listGarmentSize()
    {
        return new JsonResponse(
            $this->listGarmentSize->handle(
                new ListGarmentSizeCommand()
            ),
            Response::HTTP_OK
        );
    }
}

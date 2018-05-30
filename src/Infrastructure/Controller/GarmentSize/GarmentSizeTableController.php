<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTable;
use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTableCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GarmentSizeTableController
{
    private $handler;

    public function __construct(CreateGarmentSizeTable $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request)
    {
        $idGarment = $request->request->get("sizeValue");
        $idSize = $request->request->get("idSize");
        $sizeValue = $request->request->get("idGarment");

        $response = $this->handler->handle(new CreateGarmentSizeTableCommand($idGarment, $idSize, $sizeValue));

        return new JsonResponse($response["data"], $response["code"]);
    }
}

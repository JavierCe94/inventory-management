<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSize;
use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSizeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateGarmentSizeController
{
    private $handler;

    public function __construct(UpdateGarmentSize $handler)
    {
        $this->handler = $handler;
    }

    public function updateGarmentSize(Request $request)
    {
        $stock = $request->request->get("stock");
        $idGarment = $request->request->get("sizeValue");
        $idSize = $request->request->get("idSize");
        $sizeValue = $request->request->get("idGarment");

        $response = $this->handler->handle(new UpdateGarmentSizeCommand($idGarment, $idSize, $sizeValue, $stock));

        return new JsonResponse(
            $response,
            Response::HTTP_OK
        );
    }
}

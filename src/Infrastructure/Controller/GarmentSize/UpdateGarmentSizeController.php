<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSize;
use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateGarmentSizeController extends RoleAdmin
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
            HttpResponses::OK
        );
    }
}

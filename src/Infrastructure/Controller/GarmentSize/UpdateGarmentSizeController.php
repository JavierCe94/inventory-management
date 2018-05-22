<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 22/05/18
 * Time: 15:02
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;


use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSize;
use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSizeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateGarmentSizeController
{

    private $handler;

    /**
     * GarmentSizeTableController constructor.
     * @param $handler
     */
    public function __construct(UpdateGarmentSize $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return JsonResponse
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist
     */
    public function __invoke(Request $request)
    {
        $stock = $request->request->get("stock");
        $idGarment = $request->request->get("sizeValue");
        $idSize = $request->request->get("idSize");
        $sizeValue = $request->request->get("idGarment");

        $response = $this->handler->handle(new UpdateGarmentSizeCommand($idGarment, $idSize, $sizeValue, $stock));

        return new JsonResponse($response["data"], $response["code"]);
    }
}
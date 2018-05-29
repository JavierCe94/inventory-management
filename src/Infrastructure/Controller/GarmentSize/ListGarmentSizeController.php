<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 15/05/18
 * Time: 11:39
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize;

use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSize;
use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSizeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListGarmentSizeController
{
    private $listGarmentSize;
    public function __construct(ListGarmentSize $listGarmentSize)
    {
        $this->listGarmentSize = $listGarmentSize;
    }

    /**
     * @param array/GarmentSize[] $queryResult
     * @return JsonResponse
     */
    public function __invoke()
    {
        $result = $this->listGarmentSize->handle(new ListGarmentSizeCommand());

        return new JsonResponse($result);
    }
}
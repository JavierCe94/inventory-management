<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 03/05/2018
 * Time: 9:13
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSize;
use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSizeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListAllSizeController
{
    private $listAllSize;

    public function __construct(ListAllSize $listAllSize)
    {
        $this->listAllSize = $listAllSize;
    }

    public function __invoke()
    {
        $dataToShow = $this->listAllSize->handle(new ListAllSizeCommand());
        return new JsonResponse($dataToShow['data'], $dataToShow['code']);
    }
}

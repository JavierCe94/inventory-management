<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSize;
use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListAllSizeController extends RoleEmployee
{
    private $listAllSize;

    public function __construct(ListAllSize $listAllSize)
    {
        parent::__construct();
        $this->listAllSize = $listAllSize;
    }

    public function __invoke()
    {
        $dataToShow = $this->listAllSize->handle(new ListAllSizeCommand());
        return new JsonResponse($dataToShow, HttpResponses::OK);
    }
}

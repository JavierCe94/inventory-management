<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentType;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListSizeByGarmentTypeController extends RoleEmployee
{
    private $listSizeByGarmentType;

    public function __construct(ListSizeByGarmentType $listSizeByGarmentType)
    {
        parent::__construct();
        $this->listSizeByGarmentType = $listSizeByGarmentType;
    }

    /**
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        $garmentType = $request->request->get('garmentType');

        $dataToShow = $this->listSizeByGarmentType->handle(new ListSizeByGarmentTypeCommand($garmentType));

        return new JsonResponse($dataToShow, HttpResponses::OK);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 03/05/2018
 * Time: 9:27
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentType;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListSizeByGarmentTypeController
{
    private $listSizeByGarmentType;

    /**
     * ListSizeByGarmentTypeController constructor.
     * @param $listSizeByGarmentType
     */
    public function __construct(ListSizeByGarmentType $listSizeByGarmentType)
    {
        $this->listSizeByGarmentType = $listSizeByGarmentType;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        $garmentType = $request->request->get('garmentType');

        $dataToShow = $this->listSizeByGarmentType->handle(new ListSizeByGarmentTypeCommand($garmentType));

        return new JsonResponse($dataToShow);
    }
}

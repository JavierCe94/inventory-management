<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 03/05/2018
 * Time: 14:59
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSize;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InsertNewSizeController
{
    private $insertNewSize;

    /**
     * InsertNewSizeController constructor.
     * @param $insertNewSize
     */
    public function __construct(InsertNewSize $insertNewSize)
    {
        $this->insertNewSize = $insertNewSize;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        $sizeValue = $request->request->get('sizeValue');
        $garmentType = $request->request->get('garmentType');

        $dataToShow = $this->insertNewSize->handle(new InsertNewSizeCommand($sizeValue, $garmentType));

        return new JsonResponse($dataToShow);
    }
}

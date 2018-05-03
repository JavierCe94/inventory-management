<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 03/05/2018
 * Time: 15:56
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSize;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateSizeController
{
    private $updateSize;

    /**
     * UpdateSizeController constructor.
     * @param $updateSize
     */
    public function __construct(UpdateSize $updateSize)
    {
        $this->updateSize = $updateSize;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Assert\AssertionFailedException
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist
     */
    public function __invoke(Request $request)
    {
        $sizeValue = $request->request->get('sizeValue');
        $garmentType = $request->request->get('garmentType');
        $newSizeValue = $request->request->get('newSizeValue');

        $dataToShow = $this->updateSize->handle(new UpdateSizeCommand($sizeValue, $garmentType, $newSizeValue));

        return new JsonResponse($dataToShow);
    }
}

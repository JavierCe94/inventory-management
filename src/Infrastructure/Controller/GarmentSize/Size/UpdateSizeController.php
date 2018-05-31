<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSize;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UpdateSizeController extends RoleAdmin
{
    private $updateSize;
    public function __construct(UpdateSize $updateSize)
    {
        parent::__construct();
        $this->updateSize = $updateSize;
    }

    /**
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

        return new JsonResponse($dataToShow, HttpResponses::OK);
    }
}

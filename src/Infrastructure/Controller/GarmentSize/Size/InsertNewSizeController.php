<?php

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSize;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeCommand;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InsertNewSizeController extends RoleAdmin
{
    private $insertNewSize;

    public function __construct(InsertNewSize $insertNewSize)
    {
        parent::__construct();
        $this->insertNewSize = $insertNewSize;
    }

    /**
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        $dataToShow = $this->insertNewSize->handle(new InsertNewSizeCommand(
            $request->request->get('sizeValue'),
            $request->request->get('garmentType')
        ));

        return new JsonResponse($dataToShow, HttpResponses::OK);
    }
}

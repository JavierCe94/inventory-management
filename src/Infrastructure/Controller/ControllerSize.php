<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 9:37
 */

namespace Inventory\Management\Infrastructure\Controller;

use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeTransform;
use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSize;
use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSizeCommand;
use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSizeTransform;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentType;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeTransform;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSize;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeCommand;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSize;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeCommand;

class ControllerSize extends Controller
{

    private function sendRepositorySize()
    {
        return $this->getDoctrine()->getRepository(Size::class);
    }
    private function sendRepositoryGarmentType()
    {
        return $this->getDoctrine()->getRepository(
            'Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType'
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function insertNewSize(Request $request)
    {
        $sizeValue = $request->request->get('sizeValue');
        $garmentType = $request->request->get('garmentType');

        $sizeAlreadyExistException = 0; //BORRAR al crear excepcion

        $insertSize = new InsertNewSize(
            $this->sendRepositorySize(),
            $this->sendRepositoryGarmentType(),
            new InsertNewSizeTransform(),
            $sizeAlreadyExistException
        );

        $dataToShow = $insertSize
            ->handle(new InsertNewSizeCommand($sizeValue, $garmentType));

        return $this->json($dataToShow);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function updateSize(Request $request)
    {
        $sizeValue = $request->request->get('sizeValue');
        $garmentType = $request->request->get('garmentType');

        $exception = 0; //REFACTOR
        $updateSize = new UpdateSize(
            $this->sendRepositorySize(),
            $this->sendRepositoryGarmentType(),
            new UpdateSizeTransform(),
            $exception
        );

        $dataToShow = $updateSize->handle(new UpdateSizeCommand($sizeValue, $garmentType));

        return $this->json($dataToShow);
    }

    public function listAllSize()
    {
        $listAll = new ListAllSize(
            $this->sendRepositorySize(),
            new ListAllSizeTransform()
        );

        $dataToShow = $listAll->handle(new ListAllSizeCommand());

        return $this->json($dataToShow);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function listSizeByGarmentType(Request $request)
    {

        $garmentType = $request->request->get('garmentType');

        $exceptionService = 0; //Refactor

        $listByGarmentType = new ListSizeByGarmentType(
            $this->sendRepositorySize(),
            new ListSizeByGarmentTypeTransform(),
            $exceptionService
        );

        $dataToShow = $listByGarmentType->handle(
            new ListSizeByGarmentTypeCommand($garmentType)
        );

        return $this->json($dataToShow);
    }
}

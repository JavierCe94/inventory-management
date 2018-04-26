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
     */
    public function insertNewSize(Request $request)
    {
        $sizeValue = $request->request->get('sizeValue');
        $garmentType = $request->request->get('garmentType');

        $sizeAlreadyExistException = 0; //BORRAR al crear excepcion

        $insertSize = new InsertNewSize(
            $this->sendRepositorySize(),
            new InsertNewSizeTransform(),
            $sizeAlreadyExistException
        );

        $dataToShow = $insertSize
            ->handle(new InsertNewSizeCommand($sizeValue, $garmentType));

        return $this->json($dataToShow);
    }

    public function updateSize(Request $request)
    {
        ;
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

    public function listSizeByGarmentType(Request $request)
    {
        /**
         * Hacer el caso de uso y ver que esta respondiendo
         */
        $garmentType = $request->request->get('garmentType');
        $GarmentTypeEntity = $this->sendRepositoryGarmentType()->findGarmentTypeById($garmentType);
       /* $list = $this->sendRepositorySize()->findByGarmentType($GarmentTypeEntity);*/


        return $this->json($GarmentTypeEntity->getSizes());
    }
}

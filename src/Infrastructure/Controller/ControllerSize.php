<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 9:37
 */

namespace Inventory\Management\Infrastructure\Controller;

use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeTransform;
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

    public function deleteSize(Request $request)
    {
        ;
    }

    public function listAllSize()
    {
        ;
    }

    public function listByGarmentType(Request $request)
    {
        ;
    }
}

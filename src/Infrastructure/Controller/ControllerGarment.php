<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 9:49
 */

namespace Inventory\Management\Infrastructure\Controller;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarment;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentCommand;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentTransform;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeTransform;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypes;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypesCommand;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypesTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControllerGarment extends Controller
{

    public function insertGarment(string $name, int $garmentTypeId)
    {
        $garmentTypeIdEntity = $this->findGarmentTypeById($garmentTypeId);
        $garmentRepository = $this->getDoctrine()->getRepository(Garment::class);
        $garmentTypeRepository = $this->getDoctrine()->getRepository(GarmentType::class);
        $insertGarmentTransform = new InsertGarmentTransform();
        $insertGarment = new InsertGarment($garmentRepository, $garmentTypeRepository, $insertGarmentTransform);
        $insertGarment->handle(new InsertGarmentCommand($name, $garmentTypeIdEntity));
        return $this->json(['insert garment']);
    }

    public function insertGarmentType(string $name)
    {
        $insertGarmentTypeRepository = $this->getDoctrine()->getRepository(GarmentType::class);
        $insertGarmentTypeTransform = new InsertGarmentTypeTransform();
        $insertGarmentType = new InsertGarmentType($insertGarmentTypeRepository, $insertGarmentTypeTransform);
        $insertGarmentType->handle(new InsertGarmentTypeCommand($name));

        return $this->json(
            [
                'Status' => '200 OK'
            ]
        );
    }

    public function listGarmentTypes()
    {
        $listGarmentTypeRepository = $this->getDoctrine()->getRepository(GarmentType::class);
        $listGarmentTypesTransform = new ListGarmentTypesTransform();
        $queryOutput = (new ListGarmentTypes($listGarmentTypeRepository, $listGarmentTypesTransform))->handle(new ListGarmentTypesCommand());

        return $this->json(
            [$queryOutput]
        );
    }

    private function findGarmentTypeById(int $id): GarmentType
    {
        $listGarmentTypeRepository = $this->getDoctrine()->getRepository(GarmentType::class);
        $garmentTypeEntity = $listGarmentTypeRepository->findOneBy(['id' => $id]);
        return $garmentTypeEntity;
    }

    public function listGarment($id)
    {
        $listGarmentRepository = $this->getDoctrine()->getRepository(Garment::class);
        $garmentEntity = $listGarmentRepository->findBy(['id' => $id]);
        $tipo = $garmentEntity[0]->getGarmentType();
        return $this->json(
            [
                'garmentEntity' => '',
                'tipo' => $tipo->getName()
            ]
        );
    }
}

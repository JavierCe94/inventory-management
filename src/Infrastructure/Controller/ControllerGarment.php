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
use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarment;
use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarmentTransform;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypes;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypesTransform;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarment;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentCommand;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentTransform;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeTransform;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControllerGarment extends Controller
{
    public function insertGarment(
        string $name,
        int $garmentTypeId,
        InsertGarment $insertGarment
    ) {
        $insertGarment->handle(new InsertGarmentCommand($name, $garmentTypeId));
        return $this->json(['Garment insertado con exito']);
    }

    public function listGarment(ListGarment $listGarment)
    {
        $queryOutput = $listGarment->handle();
        return $this->json([$queryOutput]);
    }

    public function updateGarment(
        int $id,
        string $name,
        UpdateGarment $updateGarment
    ) {
        $updateGarment->handle(new UpdateGarmentCommand($id, $name));
        return $this->json(['Garment actualizado con exito']);
    }

    public function insertGarmentType(
        string $name,
        InsertGarmentType $insertGarmentType
    ) {
        $insertGarmentType->handle(new InsertGarmentTypeCommand($name));
        return $this->json(['GarmentType insertado con exito']);
    }

    // Terminar inyeccion dependencias, metodos que quedan hasta abajo
    public function listGarmentTypes(
        GarmentTypeRepository $listGarmentTypeRepository,
        ListGarmentTypesTransform $listGarmentTypesTransform
    ) {
        $queryOutput = (new ListGarmentTypes($listGarmentTypeRepository, $listGarmentTypesTransform))->handle();

        return $this->json([$queryOutput]);
    }

    public function updateGarmentType(
        int $id,
        string $name,
        GarmentTypeRepository $updateGarmentTypeRepository,
        UpdateGarmentTypeTransform $updateGarmentTypeTransform
    ) {
        $updateGarmentType = new UpdateGarmentType($updateGarmentTypeRepository, $updateGarmentTypeTransform);
        $updateGarmentType->handle(new UpdateGarmentTypeCommand($id, $name));

        return $this->json(['GarmentType actualizado con exito']);
    }

//    public function __invoke()
//    {
//
//    }
}


//$a = new ControllerGarment();
//
//$a();

<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 9:00
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UpdateGarmentTypeController extends Controller
{
    public function updateGarmentType(int $id, string $name, UpdateGarmentType $updateGarmentType)
    {
        $updateGarmentType->handle(new UpdateGarmentTypeCommand($id, $name));
        return $this->json(['GarmentType actualizado con exito']);
    }
}
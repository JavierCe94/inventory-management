<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 8:56
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InsertGarmentTypeController extends Controller
{
    public function insertGarmentType(string $name, InsertGarmentType $insertGarmentType)
    {
        $result = $insertGarmentType->handle(new InsertGarmentTypeCommand($name));
        return $this->json([$result]);
    }
}
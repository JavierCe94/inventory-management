<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 8:36
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarment;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InsertGarmentController extends Controller
{
    public function insertGarment(string $name, int $garmentTypeId, InsertGarment $insertGarment)
    {
        $result = $insertGarment->handle(new InsertGarmentCommand($name, $garmentTypeId));

        return $this->json([$result]);
    }
}
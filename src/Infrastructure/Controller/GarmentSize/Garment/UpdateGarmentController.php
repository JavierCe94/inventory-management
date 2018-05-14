<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 8:55
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarment;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UpdateGarmentController extends Controller
{
    public function updateGarment(int $id, string $name, UpdateGarment $updateGarment)
    {
        $output = $updateGarment->handle(new UpdateGarmentCommand($id, $name));
        return $this->json([$output]);
    }
}
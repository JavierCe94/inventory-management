<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 8:50
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListGarmentController extends Controller
{
    public function listGarment(ListGarment $listGarment)
    {
        $queryOutput = $listGarment->handle();
        return $this->json([$queryOutput]);
    }
}
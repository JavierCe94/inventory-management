<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 8:57
 */

namespace Inventory\Management\Infrastructure\Controller\GarmentSize\Garment;

use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListGarmentTypesController extends Controller
{
    public function listGarmentTypes(ListGarmentTypes $listGarmentTypes)
    {
        $queryOutput = $listGarmentTypes->handle();
        return $this->json($queryOutput);
    }
}

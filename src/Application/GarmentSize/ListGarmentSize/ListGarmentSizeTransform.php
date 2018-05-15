<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 15/05/18
 * Time: 12:38
 */

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;

class ListGarmentSizeTransform implements ListGarmentSizeTransformInterface
{
    /**
     * @param array/GarmentSize[] $garmentSizes
     * @return array
     */
    public function transform(array $garmentSizes): array
    {
        $transformed = [];
        foreach ($garmentSizes as $garmentSize) {
            $transformed [] = [
                $garmentSize->getGarment(),
                $garmentSize->getSize(),
                $garmentSize->getStock()
            ];
        }
        return $transformed;
    }
}
<?php

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;

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
                'garment' => $garmentSize->getGarment(),
                'size' => $garmentSize->getSize(),
                'stock' => $garmentSize->getStock()
            ];
        }
        
        return $transformed;
    }
}

<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListAllSize;

class ListAllSizeTransform implements ListAllSizeTransformInterface
{
    /**
     * @param array/Size[] $sizes
     * @return array
     */
    public function transform(array $sizes): array
    {
        $transformed = [];
        foreach ($sizes as $size) {
            $transformed [] = [
                'size' => $size->getSizeValue(),
                'tipoRopa' => $size->getGarmentType()->getName()
            ];
        }
        return $transformed;
    }
}

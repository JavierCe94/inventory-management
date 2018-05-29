<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

class ListSizeByGarmentTypeTransform implements ListSizeByGarmentTypeTransformInterface
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
                'size' => $size['sizeValue']
            ];
        }

        return $transformed;
    }
}

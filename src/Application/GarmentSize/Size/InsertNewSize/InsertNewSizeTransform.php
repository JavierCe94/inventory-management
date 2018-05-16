<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 15:23
 */

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;


class InsertNewSizeTransform implements InsertNewSizeTransformInterface
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

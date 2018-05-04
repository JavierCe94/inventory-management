<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 26/04/2018
 * Time: 12:52
 */

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

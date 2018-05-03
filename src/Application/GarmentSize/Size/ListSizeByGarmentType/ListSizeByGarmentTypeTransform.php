<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 13:05
 */

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSizeTransformInterface;

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

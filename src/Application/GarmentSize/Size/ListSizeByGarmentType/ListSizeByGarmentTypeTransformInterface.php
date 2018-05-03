<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 13:06
 */

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

interface ListSizeByGarmentTypeTransformInterface
{
    public function transform(array $sizes): array;
}

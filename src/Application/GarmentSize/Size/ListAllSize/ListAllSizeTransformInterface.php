<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 26/04/2018
 * Time: 12:52
 */

namespace Inventory\Management\Application\GarmentSize\Size\ListAllSize;


interface ListAllSizeTransformInterface
{
    public function transform(array $size): array;
}

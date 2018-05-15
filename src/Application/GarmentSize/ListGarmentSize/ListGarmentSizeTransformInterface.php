<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 15/05/18
 * Time: 12:39
 */

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;


interface ListGarmentSizeTransformInterface
{
    public function transform(array $garmentSizes): array;
}
<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 13:12
 */

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

interface ListGarmentTypesTransformInterface
{
    public function transform(array $queryInput): array;
}

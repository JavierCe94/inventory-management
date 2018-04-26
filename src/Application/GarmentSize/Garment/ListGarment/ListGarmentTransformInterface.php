<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 25/04/18
 * Time: 19:13
 */

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;


interface ListGarmentTransformInterface
{
    public function transform(array $queryInput): array;
}
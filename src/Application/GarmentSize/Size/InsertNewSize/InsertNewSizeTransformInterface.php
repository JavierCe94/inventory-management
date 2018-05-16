<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 15:23
 */

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;


interface InsertNewSizeTransformInterface
{
    public function transform(array $sizes): array ;

}
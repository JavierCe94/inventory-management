<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 11:30
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

class InsertGarmentTypeTransform implements InsertGarmentTypeTransformInterface
{
    public function transform(): array
    {
        return [
            'Status' =>'200 OK'
        ];
    }
}
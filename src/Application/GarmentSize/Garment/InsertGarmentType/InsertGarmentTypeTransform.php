<?php

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

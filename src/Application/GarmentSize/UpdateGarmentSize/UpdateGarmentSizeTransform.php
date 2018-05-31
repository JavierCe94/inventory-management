<?php

namespace Inventory\Management\Application\GarmentSize\UpdateGarmentSize;

class UpdateGarmentSizeTransform implements UpdateGarmentSizeTransformI
{
    public function transform(): string
    {
        return "stock updated";
    }
}

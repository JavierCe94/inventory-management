<?php

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

class InsertNewSizeTransform implements InsertNewSizeTransformI
{

    public function transform(): string
    {
        return "Nueva talla insertada";
    }
}

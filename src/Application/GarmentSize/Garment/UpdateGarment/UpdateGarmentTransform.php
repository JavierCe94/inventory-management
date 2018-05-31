<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarment;

class UpdateGarmentTransform implements UpdateGarmentTransformI
{
    public function transform(): string
    {
        return 'Garment actualizado con exito';
    }

}

<?php

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;

interface ListGarmentSizeTransformI
{
    public function transform(array $garmentSizes): array;
}

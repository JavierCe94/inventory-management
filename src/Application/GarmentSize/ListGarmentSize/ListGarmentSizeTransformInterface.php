<?php

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;

interface ListGarmentSizeTransformInterface
{
    public function transform(array $garmentSizes): array;
}

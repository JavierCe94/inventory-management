<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

interface ListGarmentTypesTransformI
{
    public function transform(array $queryInput): array;
}

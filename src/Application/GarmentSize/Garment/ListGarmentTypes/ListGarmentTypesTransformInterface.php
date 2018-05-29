<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

interface ListGarmentTypesTransformInterface
{
    public function transform(array $queryInput): array;
}

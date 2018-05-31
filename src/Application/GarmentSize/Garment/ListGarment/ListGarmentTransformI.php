<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;

interface ListGarmentTransformI
{
    public function transform(array $queryInput): array;
}

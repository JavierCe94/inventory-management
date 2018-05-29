<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;

interface ListGarmentTransformInterface
{
    public function transform(array $queryInput): array;
}

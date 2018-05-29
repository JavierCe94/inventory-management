<?php

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

interface InsertNewSizeTransformInterface
{
    public function transform(array $sizes): array ;
}

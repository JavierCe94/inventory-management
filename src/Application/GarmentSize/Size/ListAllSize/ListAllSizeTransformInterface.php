<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListAllSize;

interface ListAllSizeTransformInterface
{
    public function transform(array $size): array;
}

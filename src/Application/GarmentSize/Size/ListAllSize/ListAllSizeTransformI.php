<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListAllSize;

interface ListAllSizeTransformI
{
    public function transform(array $size): array;
}

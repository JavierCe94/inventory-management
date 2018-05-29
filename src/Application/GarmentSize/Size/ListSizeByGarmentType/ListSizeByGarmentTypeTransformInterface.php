<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

interface ListSizeByGarmentTypeTransformInterface
{
    public function transform(array $sizes): array;
}

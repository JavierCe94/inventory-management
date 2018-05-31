<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

interface ListSizeByGarmentTypeTransformI
{
    public function transform(array $sizes): array;
}

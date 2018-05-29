<?php

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;

interface UpdateSizeTransformInterface
{
    public function transform(Size $sizes): array;
}

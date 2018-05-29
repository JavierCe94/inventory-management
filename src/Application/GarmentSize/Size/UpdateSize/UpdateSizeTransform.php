<?php

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;

class UpdateSizeTransform implements UpdateSizeTransformInterface
{
    /**
     * @param Size $sizes
     * @return array
     */
    public function transform(Size $sizes): array
    {
        $transformed [] = [
            'sizeValue' => $sizes->getSizeValue(),
            'garmentType' => $sizes->getGarmentType()->getId()
        ];

        return $transformed;
    }
}

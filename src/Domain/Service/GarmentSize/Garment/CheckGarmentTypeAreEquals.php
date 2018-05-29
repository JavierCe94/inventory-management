<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypesAreNotEquals;

class CheckGarmentTypeAreEquals
{
    /**
     * @param GarmentType $garmentType1
     * @param GarmentType $garmentType2
     * @throws GarmentTypesAreNotEquals
     */
    public function execute(GarmentType $garmentType1, GarmentType $garmentType2)
    {
        if ($garmentType1 !== $garmentType2) {
            throw new GarmentTypesAreNotEquals();
        }
    }
}

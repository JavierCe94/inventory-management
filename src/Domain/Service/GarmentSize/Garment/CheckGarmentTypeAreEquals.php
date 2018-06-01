<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypesAreNotEquals;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\CheckGarmentTypeAreEquals
    as CheckGarmentTypeAreEqualsI;

class CheckGarmentTypeAreEquals implements CheckGarmentTypeAreEqualsI
{
    /**
     * @throws GarmentTypesAreNotEquals
     */
    public function execute(GarmentType $garmentType1, GarmentType $garmentType2)
    {
        if ($garmentType1 !== $garmentType2) {
            throw new GarmentTypesAreNotEquals();
        }
    }
}

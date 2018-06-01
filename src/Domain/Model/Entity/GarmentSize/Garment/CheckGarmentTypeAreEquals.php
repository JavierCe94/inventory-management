<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface CheckGarmentTypeAreEquals
{
    public function execute(GarmentType $garmentType1, GarmentType $garmentType2);
}

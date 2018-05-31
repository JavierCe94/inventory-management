<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

interface CheckGarmentTypeAreEqualsI
{
    public function execute(GarmentType $garmentType1, GarmentType $garmentType2);
}
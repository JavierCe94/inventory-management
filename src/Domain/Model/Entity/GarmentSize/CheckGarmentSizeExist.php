<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

interface CheckGarmentSizeExist
{
    public function execute($size, $garment): ?GarmentSize;
}

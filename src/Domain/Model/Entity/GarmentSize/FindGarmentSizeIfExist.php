<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

interface FindGarmentSizeIfExist
{
    public function execute($size, $garment): ?GarmentSize;
}

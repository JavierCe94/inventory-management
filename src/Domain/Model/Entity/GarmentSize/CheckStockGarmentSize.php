<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

interface CheckStockGarmentSize
{
    public function execute(GarmentSize $garmentSize, int $garmentSizeCount): void;
}

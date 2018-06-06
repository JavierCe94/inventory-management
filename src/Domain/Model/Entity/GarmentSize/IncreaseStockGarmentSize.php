<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

interface IncreaseStockGarmentSize
{
    public function execute(GarmentSize $garmentSize, int $countGarmentSize): void;
}

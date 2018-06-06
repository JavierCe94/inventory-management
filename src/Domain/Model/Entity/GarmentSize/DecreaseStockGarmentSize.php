<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

interface DecreaseStockGarmentSize
{
    public function execute(GarmentSize $garmentSize, int $countGarmentSize): void;
}

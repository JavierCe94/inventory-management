<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

interface FindGarmentSizeIfExistI
{
    public function __invoke($size, $garment): ?GarmentSize;
}

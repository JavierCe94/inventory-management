<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

interface CheckGarmentSizeExistI
{
    public function __invoke($size, $garment): ?GarmentSize;
}


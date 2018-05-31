<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

interface FindGarmentTypeIfExistI
{
    public function execute(int $id): ?GarmentType;
}

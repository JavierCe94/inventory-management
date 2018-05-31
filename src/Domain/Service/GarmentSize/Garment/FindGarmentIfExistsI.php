<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

interface FindGarmentIfExistsI
{
    public function execute(int $id): ?Garment;
}

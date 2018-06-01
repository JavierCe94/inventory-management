<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface FindGarmentIfExists
{
    public function execute(int $id): ?Garment;
}

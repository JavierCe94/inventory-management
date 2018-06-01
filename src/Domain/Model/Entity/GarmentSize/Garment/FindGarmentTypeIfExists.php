<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface FindGarmentTypeIfExists
{
    public function execute(int $id): GarmentType;
}

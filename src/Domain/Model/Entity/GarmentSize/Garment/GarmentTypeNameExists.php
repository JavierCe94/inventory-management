<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface GarmentTypeNameExists
{
    public function execute(string $name);
}

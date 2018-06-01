<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface GarmentNameExists
{
    public function execute(string $name): void;
}

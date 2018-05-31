<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

interface GarmentNameExistI
{
    public function check(string $name): void;
}

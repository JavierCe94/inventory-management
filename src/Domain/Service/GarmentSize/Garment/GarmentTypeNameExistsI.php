<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

interface GarmentTypeNameExistsI
{
    public function check(string $name);
}

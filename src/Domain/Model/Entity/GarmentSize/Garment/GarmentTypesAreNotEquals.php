<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class GarmentTypesAreNotEquals extends NotFoundException
{
    public function message(): string
    {
        return 'Los tipos de prenda no son iguales';
    }
}

<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class GarmentTypeNotExistsException extends NotFoundException
{
    public function message(): string
    {
        return 'El tipo de prenda no existe';
    }
}

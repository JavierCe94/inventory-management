<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class GarmentNotExistsException extends NotFoundException
{
    public function message(): string
    {
        return 'La prenda no existe';
    }
}

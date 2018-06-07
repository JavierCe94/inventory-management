<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class GarmentTypeNameExistsException extends ConflictSearchException
{
    public function message(): string
    {
        return 'El tipo de prenda ya existe';
    }
}

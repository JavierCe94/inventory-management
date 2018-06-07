<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class GarmentNameExistsException extends ConflictSearchException
{
    public function message(): string
    {
        return 'El nombre de la prenda ya existe';
    }
}

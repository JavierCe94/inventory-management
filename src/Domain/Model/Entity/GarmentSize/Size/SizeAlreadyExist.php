<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class SizeAlreadyExist extends ConflictSearchException
{
    public function message(): string
    {
        return 'Esta talla ya existe';
    }
}

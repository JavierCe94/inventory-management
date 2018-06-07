<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class SizeDoNotExist extends NotFoundException
{
    public function message(): string
    {
        return 'Esta talla no existe';
    }
}

<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class NotFoundStockGarmentSizeException extends NotFoundException
{
    public function message(): string
    {
        return 'No hay suficiente stock';
    }
}

<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

use Inventory\Management\Domain\Model\Exception\NotFoundException;

class GarmentSizeNotExist extends NotFoundException
{
    public function message(): string
    {
        return 'GarmentSize Do Not Exist';
    }
}

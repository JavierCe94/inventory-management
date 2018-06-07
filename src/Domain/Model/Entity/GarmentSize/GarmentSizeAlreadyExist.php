<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

use Inventory\Management\Domain\Model\Exception\ConflictSearchException;

class GarmentSizeAlreadyExist extends ConflictSearchException
{
    public function message(): string
    {
        return 'GarmentSize Already Exist';
    }
}

<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Size;

interface CheckIfSizeEntityExistI
{
    public function check(int $id, int $sizeValue);
}

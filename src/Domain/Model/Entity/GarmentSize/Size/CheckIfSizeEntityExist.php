<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

interface CheckIfSizeEntityExist
{
    public function execute(int $id, int $sizeValue);
}

<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

interface CheckIfSizeExist
{
    public function execute(int $id, string $sizeValue);
}

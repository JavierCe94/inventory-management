<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

interface FindSizeEntityIfExists
{
    public function execute(int $id, int $sizeValue): ?Size;
}

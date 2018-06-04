<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

interface FindSizeIfExists
{
    public function execute(int $id, string $sizeValue): ?Size;
}

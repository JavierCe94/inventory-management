<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Size;

interface FindSizeEntityIfExistsI
{
    public function execute(int $id, int $sizeValue): ?Size;
}

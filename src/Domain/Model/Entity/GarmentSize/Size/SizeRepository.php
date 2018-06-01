<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

interface SizeRepository
{
    public function addSize(Size $size): Size;
    public function findAllSize(): array;
    public function updateSize(Size $size, $sizeValue): Size;
    public function findSizeBySizeValueAndGarmentType($sizeValue, $garmentTypeId);
    public function findByGarmentType($garmentTypeId): array;
}

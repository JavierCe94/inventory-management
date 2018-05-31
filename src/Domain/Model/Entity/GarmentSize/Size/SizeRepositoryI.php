<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

interface SizeRepositoryI
{
    public function persistAndFlush(Size $size);
    public function addSize($sizeValue, $garmentType): Size;
    public function findAllSize();
    public function updateSize($sizeValue, Size $size): Size;
    public function findSizeBySizeValueAndGarmentType($sizeValue, $garmentTypeId);
    public function findByGarmentType($garmentTypeId): array;
}

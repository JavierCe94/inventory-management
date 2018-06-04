<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

interface SizeRepository
{
    public function addSize(Size $size): Size;
    public function findAllSize(): array;
    public function updateSize(Size $size, string $sizeValue): Size;
    public function findSizeBySizeValueAndGarmentType(string $sizeValue, int $garmentTypeId): ?Size;
    public function findByGarmentType(int $garmentTypeId): array;
}

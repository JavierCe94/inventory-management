<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

interface GarmentSizeRepository
{
    public function createGarmentSize(GarmentSize $garmentSize): GarmentSize;
    public function updateStockGarmentSize(GarmentSize $garmentSize, int $stock): GarmentSize;
    public function findAllGarmentSize(): array;
    public function findByGarmentAndSizeId(int $size, int $garment): ?GarmentSize;
}

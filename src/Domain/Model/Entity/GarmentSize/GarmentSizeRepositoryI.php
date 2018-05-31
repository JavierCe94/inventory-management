<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

interface GarmentSizeRepositoryI
{
    public function persistAndFlush(GarmentSize $garmentSize);
    public function findAllGarmentSize();
    public function findByGarmentAndSizeId(int $size, int $garment): ?GarmentSize;
}

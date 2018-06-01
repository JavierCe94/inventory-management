<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface GarmentTypeRepository
{
    public function insertGarmentType(GarmentType $garmentType): GarmentType;
    public function listGarmentTypes(): array;
    public function findGarmentTypeById(int $id): ?GarmentType;
    public function findGarmentTypeByName(string $name): ?GarmentType;
    public function updateGarmentType(GarmentType $garmentType, string $name): GarmentType;
}

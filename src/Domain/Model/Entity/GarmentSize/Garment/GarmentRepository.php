<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface GarmentRepository
{
    public function insertGarment(Garment $garment): Garment;
    public function listGarment(): array;
    public function updateGarment(Garment $garment, string $name): Garment;
    public function findGarmentById(int $id): ?Garment;
    public function findGarmentByName(string $name): ?Garment;
}

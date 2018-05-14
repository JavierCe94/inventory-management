<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 26/04/18
 * Time: 9:32
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface GarmentRepositoryInterface
{
    public function insertGarment(string $name, GarmentType $garmentTypeId): ?Garment;

    public function listGarment(): array;

    public function updateGarment(Garment $garmentEntity, string $name):void;

    public function findGarmentById(int $id): ?Garment;

    public function findGarmentByName(string $name): ?Garment;

    public function persistAndFlush(Garment $garmentEntity): void;
}
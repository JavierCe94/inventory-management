<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 11:54
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface GarmentTypeRepositoryInterface
{
    public function insertGarmentType(string $name): GarmentType;

    public function listGarmentTypes(): array;

    public function findGarmentTypeById(int $id): GarmentType;

    public function persistAndFlush(GarmentType $garmentTypeEntity): void;
}
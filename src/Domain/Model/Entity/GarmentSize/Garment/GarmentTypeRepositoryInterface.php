<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 26/04/2018
 * Time: 9:48
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

interface GarmentTypeRepositoryInterface
{
    public function insertGarmentType(string $name): GarmentType;
    public function listGarmentTypes(): array;
    public function findGarmentTypeById(int $id): ?GarmentType;
    public function findGarmentTypeByName(string $name): ?GarmentType;
    public function persistAndFlush(GarmentType $garmentTypeEntity): void;
}

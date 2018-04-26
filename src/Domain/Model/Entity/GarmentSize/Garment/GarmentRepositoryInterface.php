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
    public function insertGarment(string $name, GarmentType $garmentTypeId): Garment;

    public function persistAndFlush(Garment $garmentEntity): void;
}
<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 11:20
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

interface SizeRepositoryInterface
{
    public function persistAndFlush(Size $size);

    public function addSize($sizeValue, $garmentType): Size;

    public function findAllSize();

    public function updateSize($sizeValue, Size $size): Size;

    public function findSizeBySizeValueAndGarmentType($sizeValue, $garmentTypeId): ?Size;

    public function findByGarmentType($garmentTypeId): array;
}

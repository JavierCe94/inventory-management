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

}
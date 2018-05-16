<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 15/05/18
 * Time: 11:19
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;


interface GarmentSizeRepositoryInterface
{
    public function persistAndFlush(GarmentSize $garmentSize);

    public function findAllGarmentSize();
}
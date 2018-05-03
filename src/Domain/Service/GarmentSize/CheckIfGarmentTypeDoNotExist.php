<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 26/04/2018
 * Time: 9:55
 */

namespace Inventory\Management\Domain\Service\GarmentSize;


use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeDoNotExist;

class CheckIfGarmentTypeDoNotExist
{
    /**
     * @param array $garmentType
     * @return array
     * @throws GarmentTypeDoNotExist
     */
    public function execute(array $garmentType): array
    {
        if (0 === count($garmentType)) {
            throw new GarmentTypeDoNotExist('No se encontro el tipo de prenda');
        }
        return $garmentType;
    }
}

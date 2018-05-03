<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 02/05/2018
 * Time: 8:36
 */

namespace Inventory\Management\Domain\Service\GarmentSize;

use \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeAlreadyExistException;

class GarmentTypeAlreadyExist
{
    /**
     * @param array $garmentType
     * @return array
     * @throws GarmentTypeAlreadyExistException
     */
    public function execute(array $garmentType): array
    {
        if (0 !== count($garmentType)) {
            throw new GarmentTypeAlreadyExistException('No se encontro el tipo de prenda');
        }
        return $garmentType;
    }

}

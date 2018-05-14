<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 13:13
 */

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

class ListGarmentTypesTransform implements ListGarmentTypesTransformInterface
{
    /**
     * @param array/GarmentType[] $queryInput
     *
     * @return array
     */
    public function transform(array $queryInput): array
    {
        foreach ($queryInput as $i => $garmentType) {
            $queryOutput [] =
                [
                    "id" => $garmentType->getId(),
                    "name" => $garmentType->getName()
                ];
        }
        return $queryOutput;
    }
}
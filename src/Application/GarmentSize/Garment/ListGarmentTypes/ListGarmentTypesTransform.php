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
    public function transform(array $queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $garmentType) {
            $queryOutput [] =
                [
                    "Tipo" => $garmentType->getName()
                ];
        }
        return $queryOutput;
    }
}
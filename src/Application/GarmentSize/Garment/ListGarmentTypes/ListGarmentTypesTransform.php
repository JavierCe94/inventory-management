<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

class ListGarmentTypesTransform implements ListGarmentTypesTransformI
{
    /**
     * @param array/GarmentType[] $queryInput
     * @return array
     */
    public function transform(array $queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $garmentType) {
            $queryOutput [] =
                [
                    "id" => $garmentType->getId(),
                    "name" => $garmentType->getName()
                ];
        }

        return $queryOutput;
    }
}

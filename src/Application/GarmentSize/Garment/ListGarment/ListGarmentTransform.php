<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;

class ListGarmentTransform implements ListGarmentTransformInterface
{
    /**
     * @param array/Garment[] $garments
     * @return array
     */
    public function transform(array $garments): array
    {
        $queryOutput = [];
        foreach ($garments as $garment) {
            $queryOutput [] =
                [
                    'id'=> $garment->getId(),
                    'name' => $garment->getName(),
                    'garment_type' => [
                        'id' => $garment->getGarmentType()->getId(),
                        'name'=> $garment->getGarmentType()->getName()
                    ]
                ];
        }
        
        return $queryOutput;
    }
}

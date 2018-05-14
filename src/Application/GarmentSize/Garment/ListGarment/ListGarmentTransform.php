<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 25/04/18
 * Time: 19:12
 */

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;


use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;

class ListGarmentTransform implements ListGarmentTransformInterface
{
    /**
     * @param array/Garment[] $garments
     *
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
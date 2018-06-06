<?php

namespace Inventory\Management\Application\RequestEmployee\ShowRequestEmployeeGarments;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarment;

class ShowRequestEmployeeGarmentsTransform implements ShowRequestEmployeeGarmentsTransformI
{
    /**
     * @param array|RequestEmployeeGarment[] $requestGarments
     * @return array
     */
    public function transform(array $requestGarments)
    {
        $listRequestGarments = [];
        foreach ($requestGarments as $requestGarment) {
            $garmentSize = [
                'garment' => [
                    'name' => $requestGarment->getGarmentSize()->getGarment()->getName(),
                    'type' => $requestGarment->getGarmentSize()->getGarment()->getGarmentType()->getName()
                ],
                'size' => [
                    'name' => $requestGarment->getGarmentSize()->getSize()->getSizeValue(),
                    'type' => $requestGarment->getGarmentSize()->getSize()->getGarmentType()->getName()
                ]
            ];

            $listRequestGarments[] = [
                'id' => $requestGarment->getId(),
                'isDeleted' => $requestGarment->getIsDeleted(),
                $garmentSize
            ];
        }

        return $listRequestGarments;
    }
}

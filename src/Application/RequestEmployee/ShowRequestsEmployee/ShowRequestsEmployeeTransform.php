<?php

namespace Inventory\Management\Application\RequestEmployee\ShowRequestsEmployee;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployee;

class ShowRequestsEmployeeTransform implements ShowRequestsEmployeeTransformI
{
    private const ATOM = 'd-m-Y';

    /**
     * @param array|RequestEmployee[] $requestsEmployee
     * @return array
     */
    public function transform(array $requestsEmployee)
    {
        $listRequestsEmployee = [];
        foreach ($requestsEmployee as $requestEmployee) {
            $listRequestsEmployee[] = [
                'id' => $requestEmployee->getId(),
                'dateCreation' => $requestEmployee->getDateCreation()->format(self::ATOM),
                'dateModification' => $requestEmployee->getDateModification()->format(self::ATOM),
                'status' => $requestEmployee->getStatus()
            ];
        }

        return $listRequestsEmployee;
    }
}

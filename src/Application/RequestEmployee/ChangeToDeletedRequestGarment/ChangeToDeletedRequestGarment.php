<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeToDeletedRequestGarment;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestGarmentIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;

class ChangeToDeletedRequestGarment
{
    private $requestEmployeeGarmentRepository;
    private $changeToDeletedRequestGarmentTransform;
    private $checkRequestGarmentIsFromEmployee;

    public function __construct(
        RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository,
        ChangeToDeletedRequestGarmentTransformI $changeToDeletedRequestGarmentTransform,
        CheckRequestGarmentIsFromEmployee $checkRequestGarmentIsFromEmployee
    ) {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
        $this->changeToDeletedRequestGarmentTransform = $changeToDeletedRequestGarmentTransform;
        $this->checkRequestGarmentIsFromEmployee = $checkRequestGarmentIsFromEmployee;
    }

    public function execute(ChangeToDeletedRequestGarmentCommand $changeToDeletedRequestGarmentCommand): string
    {
        $this->requestEmployeeGarmentRepository->changeStateRequestEmployeeGarment(
            $this->checkRequestGarmentIsFromEmployee->execute(
                $changeToDeletedRequestGarmentCommand->nifEmployee(),
                $changeToDeletedRequestGarmentCommand->idRequestGarment()
            ),
            true
        );

        return $this->changeToDeletedRequestGarmentTransform->transform();
    }
}

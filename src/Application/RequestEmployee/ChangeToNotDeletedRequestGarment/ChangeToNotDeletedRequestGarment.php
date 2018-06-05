<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeToNotDeletedRequestGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\CheckStockGarmentSize;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestGarmentIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;

class ChangeToNotDeletedRequestGarment
{
    private const ONE_GARMENT = 1;

    private $requestEmployeeGarmentRepository;
    private $changeToNotDeletedRequestGarmentTransform;
    private $checkRequestGarmentIsFromEmployee;
    private $checkStockGarmentSize;

    public function __construct(
        RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository,
        ChangeToNotDeletedRequestGarmentTransformI $changeToNotDeletedRequestGarmentTransform,
        CheckRequestGarmentIsFromEmployee $checkRequestGarmentIsFromEmployee,
        CheckStockGarmentSize $checkStockGarmentSize
    ) {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
        $this->changeToNotDeletedRequestGarmentTransform = $changeToNotDeletedRequestGarmentTransform;
        $this->checkRequestGarmentIsFromEmployee = $checkRequestGarmentIsFromEmployee;
        $this->checkStockGarmentSize = $checkStockGarmentSize;
    }

    public function handle(ChangeToNotDeletedRequestGarmentCommand $changeToNotDeletedRequestGarmentCommand)
    {
        $requestGarment = $this->checkRequestGarmentIsFromEmployee->execute(
            $changeToNotDeletedRequestGarmentCommand->nifEmployee(),
            $changeToNotDeletedRequestGarmentCommand->idRequestGarment()
        );
        $this->checkStockGarmentSize->execute(
            $requestGarment->getGarmentSize(),
            self::ONE_GARMENT
        );
        $this->requestEmployeeGarmentRepository->changeStateRequestEmployeeGarment(
            $requestGarment,
            false
        );

        return $this->changeToNotDeletedRequestGarmentTransform->transform();
    }
}

<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeToDeletedRequestGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\IncreaseStockGarmentSize;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestGarmentIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;

class ChangeToDeletedRequestGarment
{
    private const ONE_GARMENT = 1;

    private $requestEmployeeGarmentRepository;
    private $changeToDeletedRequestGarmentTransform;
    private $checkRequestGarmentIsFromEmployee;
    private $increaseStockGarmentSize;

    public function __construct(
        RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository,
        ChangeToDeletedRequestGarmentTransformI $changeToDeletedRequestGarmentTransform,
        CheckRequestGarmentIsFromEmployee $checkRequestGarmentIsFromEmployee,
        IncreaseStockGarmentSize $increaseStockGarmentSize
    ) {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
        $this->changeToDeletedRequestGarmentTransform = $changeToDeletedRequestGarmentTransform;
        $this->checkRequestGarmentIsFromEmployee = $checkRequestGarmentIsFromEmployee;
        $this->increaseStockGarmentSize = $increaseStockGarmentSize;
    }

    public function handle(ChangeToDeletedRequestGarmentCommand $changeToDeletedRequestGarmentCommand): string
    {
        $requestGarment = $this->checkRequestGarmentIsFromEmployee->execute(
            $changeToDeletedRequestGarmentCommand->nifEmployee(),
            $changeToDeletedRequestGarmentCommand->idRequestGarment()
        );
        $this->increaseStockGarmentSize->execute(
            $requestGarment->getGarmentSize(),
            self::ONE_GARMENT
        );
        $this->requestEmployeeGarmentRepository->changeStateRequestEmployeeGarment(
            $requestGarment,
            true
        );

        return $this->changeToDeletedRequestGarmentTransform->transform();
    }
}

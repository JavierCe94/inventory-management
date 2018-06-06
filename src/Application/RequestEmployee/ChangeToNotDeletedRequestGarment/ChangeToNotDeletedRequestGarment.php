<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeToNotDeletedRequestGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\DecreaseStockGarmentSize;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestGarmentIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;

class ChangeToNotDeletedRequestGarment
{
    private const ONE_GARMENT = 1;

    private $requestEmployeeGarmentRepository;
    private $changeToNotDeletedRequestGarmentTransform;
    private $checkRequestGarmentIsFromEmployee;
    private $decreaseStockGarmentSize;

    public function __construct(
        RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository,
        ChangeToNotDeletedRequestGarmentTransformI $changeToNotDeletedRequestGarmentTransform,
        CheckRequestGarmentIsFromEmployee $checkRequestGarmentIsFromEmployee,
        DecreaseStockGarmentSize $decreaseStockGarmentSize
    ) {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
        $this->changeToNotDeletedRequestGarmentTransform = $changeToNotDeletedRequestGarmentTransform;
        $this->checkRequestGarmentIsFromEmployee = $checkRequestGarmentIsFromEmployee;
        $this->decreaseStockGarmentSize = $decreaseStockGarmentSize;
    }

    public function handle(ChangeToNotDeletedRequestGarmentCommand $changeToNotDeletedRequestGarmentCommand)
    {
        $requestGarment = $this->checkRequestGarmentIsFromEmployee->execute(
            $changeToNotDeletedRequestGarmentCommand->nifEmployee(),
            $changeToNotDeletedRequestGarmentCommand->idRequestGarment()
        );
        $this->decreaseStockGarmentSize->execute(
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

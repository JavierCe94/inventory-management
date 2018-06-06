<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeletedRequest;

use Inventory\Management\Domain\Model\Entity\GarmentSize\IncreaseStockGarmentSize;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;

class ChangeStatusToDeletedRequest
{
    private const ONE_GARMENT = 1;

    private $requestEmployeeRepository;
    private $changeStatusToDeletedRequestTransform;
    private $checkRequestIsFromEmployee;
    private $increaseStockGarmentSize;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToDeletedRequestTransformI $changeStatusToDeletedRequestTransform,
        CheckRequestIsFromEmployee $checkRequestIsFromEmployee,
        IncreaseStockGarmentSize $increaseStockGarmentSize
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToDeletedRequestTransform = $changeStatusToDeletedRequestTransform;
        $this->checkRequestIsFromEmployee = $checkRequestIsFromEmployee;
        $this->increaseStockGarmentSize = $increaseStockGarmentSize;
    }

    public function handle(ChangeStatusToDeletedRequestCommand $changeStatusToDeletedRequestCommand): string
    {
        $requestEmployee = $this->checkRequestIsFromEmployee->execute(
            $changeStatusToDeletedRequestCommand->employee(),
            $changeStatusToDeletedRequestCommand->id()
        );
        foreach ($requestEmployee->getRequestEmployeeGarment() as $requestEmployeeGarment) {
            $this->increaseStockGarmentSize->execute(
                $requestEmployeeGarment->getGarmentSize(),
                self::ONE_GARMENT
            );
        }
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $requestEmployee,
            RequestEmployeeStatus::STATUS_DRAFT_DELETED
        );

        return $this->changeStatusToDeletedRequestTransform->transform();
    }
}

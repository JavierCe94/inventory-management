<?php

namespace Inventory\Management\Application\RequestEmployee\CreateRequestEmployeeGarments;

use Inventory\Management\Domain\Model\Entity\GarmentSize\DecreaseStockGarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\FindGarmentSizeIfExist;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarment;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;

class CreateRequestEmployeeGarments
{
    private $requestEmployeeGarmentRepository;
    private $createRequestEmployeeGarmentsTransform;
    private $checkRequestIsFromEmployee;
    private $findGarmentSizeIfExist;
    private $decreaseStockGarmentSize;

    public function __construct(
        RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository,
        CreateRequestEmployeeGarmentsTransformI $createRequestEmployeeGarmentsTransform,
        CheckRequestIsFromEmployee $checkRequestIsFromEmployee,
        FindGarmentSizeIfExist $findGarmentSizeIfExist,
        DecreaseStockGarmentSize $decreaseStockGarmentSize
    ) {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
        $this->createRequestEmployeeGarmentsTransform = $createRequestEmployeeGarmentsTransform;
        $this->checkRequestIsFromEmployee = $checkRequestIsFromEmployee;
        $this->findGarmentSizeIfExist = $findGarmentSizeIfExist;
        $this->decreaseStockGarmentSize = $decreaseStockGarmentSize;
    }

    public function handle(CreateRequestEmployeeGarmentsCommand $createRequestEmployeeGarmentsCommand): string
    {
        $requestEmployee = $this->checkRequestIsFromEmployee->execute(
            $createRequestEmployeeGarmentsCommand->employee(),
            $createRequestEmployeeGarmentsCommand->requestEmployee()
        );
        $garmentSize = $this->findGarmentSizeIfExist->execute(
            $createRequestEmployeeGarmentsCommand->size(),
            $createRequestEmployeeGarmentsCommand->garment()
        );
        $this->decreaseStockGarmentSize->execute(
            $garmentSize,
            $createRequestEmployeeGarmentsCommand->count()
        );
        $requestEmployeeGarments = [];
        for ($i = 0; $i < $createRequestEmployeeGarmentsCommand->count(); $i++) {
            $requestEmployeeGarments[] = new RequestEmployeeGarment(
                $requestEmployee,
                $garmentSize
            );
        }
        $this->requestEmployeeGarmentRepository->createRequestEmployeeGarments(
            $requestEmployeeGarments
        );

        return $this->createRequestEmployeeGarmentsTransform->transform();
    }
}

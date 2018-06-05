<?php

namespace Inventory\Management\Application\RequestEmployee\CreateRequestEmployeeGarments;

use Inventory\Management\Domain\Model\Entity\GarmentSize\CheckStockGarmentSize;
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
    private $checkStockGarmentSize;

    public function __construct(
        RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository,
        CreateRequestEmployeeGarmentsTransformI $createRequestEmployeeGarmentsTransform,
        CheckRequestIsFromEmployee $checkRequestIsFromEmployee,
        FindGarmentSizeIfExist $findGarmentSizeIfExist,
        CheckStockGarmentSize $checkStockGarmentSize
    ) {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
        $this->createRequestEmployeeGarmentsTransform = $createRequestEmployeeGarmentsTransform;
        $this->checkRequestIsFromEmployee = $checkRequestIsFromEmployee;
        $this->findGarmentSizeIfExist = $findGarmentSizeIfExist;
        $this->checkStockGarmentSize = $checkStockGarmentSize;
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
        $this->checkStockGarmentSize->execute(
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

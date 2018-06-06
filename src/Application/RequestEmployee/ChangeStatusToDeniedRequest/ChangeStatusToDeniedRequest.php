<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeniedRequest;

use Inventory\Management\Domain\Model\Entity\GarmentSize\IncreaseStockGarmentSize;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById;

class ChangeStatusToDeniedRequest
{
    private const ONE_GARMENT = 1;

    private $requestEmployeeRepository;
    private $changeStatusToDeniedRequestTransform;
    private $searchRequestEmployeeById;
    private $increaseStockGarmentSize;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToDeniedRequestTransformI $changeStatusToDeniedRequestTransform,
        SearchRequestEmployeeById $searchRequestEmployeeById,
        IncreaseStockGarmentSize $increaseStockGarmentSize
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToDeniedRequestTransform = $changeStatusToDeniedRequestTransform;
        $this->searchRequestEmployeeById = $searchRequestEmployeeById;
        $this->increaseStockGarmentSize = $increaseStockGarmentSize;
    }

    public function handle(ChangeStatusToDeniedRequestCommand $changeStatusToDeniedRequestCommand): string
    {
        $requestEmployee = $this->searchRequestEmployeeById->execute(
            $changeStatusToDeniedRequestCommand->id()
        );
        foreach ($requestEmployee->getRequestEmployeeGarment() as $requestEmployeeGarment) {
            $this->increaseStockGarmentSize->execute(
                $requestEmployeeGarment->getGarmentSize(),
                self::ONE_GARMENT
            );
        }
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $requestEmployee,
            RequestEmployeeStatus::STATUS_DENIED
        );

        return $this->changeStatusToDeniedRequestTransform->transform();
    }
}

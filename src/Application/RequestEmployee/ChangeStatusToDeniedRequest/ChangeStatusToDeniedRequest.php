<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeniedRequest;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById;

class ChangeStatusToDeniedRequest
{
    private $requestEmployeeRepository;
    private $changeStatusToDeniedRequestTransform;
    private $searchRequestEmployeeById;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToDeniedRequestTransformI $changeStatusToDeniedRequestTransform,
        SearchRequestEmployeeById $searchRequestEmployeeById
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToDeniedRequestTransform = $changeStatusToDeniedRequestTransform;
        $this->searchRequestEmployeeById = $searchRequestEmployeeById;
    }

    public function handle(ChangeStatusToDeniedRequestCommand $changeStatusToDeniedRequestCommand): string
    {
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $this->searchRequestEmployeeById->execute(
                $changeStatusToDeniedRequestCommand->id()
            ),
            RequestEmployeeStatus::STATUS_DENIED
        );

        return $this->changeStatusToDeniedRequestTransform->transform();
    }
}

<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToAcceptedRequest;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById;

class ChangeStatusToAcceptedRequest
{
    private $requestEmployeeRepository;
    private $changeStatusToAcceptedRequestTransform;
    private $searchRequestEmployeeById;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToAcceptedRequestTransformI $changeStatusToAcceptedRequestTransform,
        SearchRequestEmployeeById $searchRequestEmployeeById
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToAcceptedRequestTransform = $changeStatusToAcceptedRequestTransform;
        $this->searchRequestEmployeeById = $searchRequestEmployeeById;
    }

    public function handle(ChangeStatusToAcceptedRequestCommand $changeStatusToAcceptedRequestCommand): string
    {
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $this->searchRequestEmployeeById->execute(
                $changeStatusToAcceptedRequestCommand->id()
            ),
            RequestEmployeeStatus::STATUS_ACCEPTED
        );

        return $this->changeStatusToAcceptedRequestTransform->transform();
    }
}

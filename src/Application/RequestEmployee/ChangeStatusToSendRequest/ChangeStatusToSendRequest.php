<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToSendRequest;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById;

class ChangeStatusToSendRequest
{
    private $requestEmployeeRepository;
    private $changeStatusToSendRequestTransform;
    private $searchRequestEmployeeById;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToSendRequestTransformI $changeStatusToSendRequestTransform,
        SearchRequestEmployeeById $searchRequestEmployeeById
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToSendRequestTransform = $changeStatusToSendRequestTransform;
        $this->searchRequestEmployeeById = $searchRequestEmployeeById;
    }

    public function handle(ChangeStatusToSendRequestCommand $changeStatusToSendRequestCommand): string
    {
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $this->searchRequestEmployeeById->execute(
                $changeStatusToSendRequestCommand->id()
            ),
            RequestEmployeeStatus::STATUS_SEND
        );

        return $this->changeStatusToSendRequestTransform->transform();
    }
}

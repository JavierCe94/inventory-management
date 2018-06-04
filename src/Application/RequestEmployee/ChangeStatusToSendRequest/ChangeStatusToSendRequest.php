<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToSendRequest;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById;

class ChangeStatusToSendRequest
{
    private $requestEmployeeRepository;
    private $changeStatusToSendRequestTransform;
    private $searchRequestEmployeeById;
    private $checkRequestIsFromEmployee;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToSendRequestTransformI $changeStatusToSendRequestTransform,
        SearchRequestEmployeeById $searchRequestEmployeeById,
        CheckRequestIsFromEmployee $checkRequestIsFromEmployee
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToSendRequestTransform = $changeStatusToSendRequestTransform;
        $this->searchRequestEmployeeById = $searchRequestEmployeeById;
        $this->checkRequestIsFromEmployee = $checkRequestIsFromEmployee;
    }

    public function handle(ChangeStatusToSendRequestCommand $changeStatusToSendRequestCommand): string
    {
        $this->checkRequestIsFromEmployee->execute(
            $changeStatusToSendRequestCommand->employee(),
            $changeStatusToSendRequestCommand->id()
        );
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $this->searchRequestEmployeeById->execute(
                $changeStatusToSendRequestCommand->id()
            ),
            RequestEmployeeStatus::STATUS_SEND
        );

        return $this->changeStatusToSendRequestTransform->transform();
    }
}

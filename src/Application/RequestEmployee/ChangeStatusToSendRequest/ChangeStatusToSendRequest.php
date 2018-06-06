<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToSendRequest;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;

class ChangeStatusToSendRequest
{
    private $requestEmployeeRepository;
    private $changeStatusToSendRequestTransform;
    private $checkRequestIsFromEmployee;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToSendRequestTransformI $changeStatusToSendRequestTransform,
        CheckRequestIsFromEmployee $checkRequestIsFromEmployee
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToSendRequestTransform = $changeStatusToSendRequestTransform;
        $this->checkRequestIsFromEmployee = $checkRequestIsFromEmployee;
    }

    public function handle(ChangeStatusToSendRequestCommand $changeStatusToSendRequestCommand): string
    {
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $this->checkRequestIsFromEmployee->execute(
                $changeStatusToSendRequestCommand->employee(),
                $changeStatusToSendRequestCommand->id()
            ),
            RequestEmployeeStatus::STATUS_SEND
        );

        return $this->changeStatusToSendRequestTransform->transform();
    }
}

<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeletedRequest;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;

class ChangeStatusToDeletedRequest
{
    private $requestEmployeeRepository;
    private $changeStatusToDeletedRequestTransform;
    private $checkRequestIsFromEmployee;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToDeletedRequestTransformI $changeStatusToDeletedRequestTransform,
        CheckRequestIsFromEmployee $checkRequestIsFromEmployee
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToDeletedRequestTransform = $changeStatusToDeletedRequestTransform;
        $this->checkRequestIsFromEmployee = $checkRequestIsFromEmployee;
    }

    public function handle(ChangeStatusToDeletedRequestCommand $changeStatusToDeletedRequestCommand): string
    {
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $this->checkRequestIsFromEmployee->execute(
                $changeStatusToDeletedRequestCommand->employee(),
                $changeStatusToDeletedRequestCommand->id()
            ),
            RequestEmployeeStatus::STATUS_DRAFT_DELETED
        );

        return $this->changeStatusToDeletedRequestTransform->transform();
    }
}

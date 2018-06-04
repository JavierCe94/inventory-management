<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeletedRequest;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestIsFromEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById;

class ChangeStatusToDeletedRequest
{
    private $requestEmployeeRepository;
    private $changeStatusToDeletedRequestTransform;
    private $searchRequestEmployeeById;
    private $checkRequestIsFromEmployee;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToDeletedRequestTransformI $changeStatusToDeletedRequestTransform,
        SearchRequestEmployeeById $searchRequestEmployeeById,
        CheckRequestIsFromEmployee $checkRequestIsFromEmployee
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToDeletedRequestTransform = $changeStatusToDeletedRequestTransform;
        $this->searchRequestEmployeeById = $searchRequestEmployeeById;
        $this->checkRequestIsFromEmployee = $checkRequestIsFromEmployee;
    }

    public function handle(ChangeStatusToDeletedRequestCommand $changeStatusToDeletedRequestCommand): string
    {
        $this->checkRequestIsFromEmployee->execute(
            $changeStatusToDeletedRequestCommand->employee(),
            $changeStatusToDeletedRequestCommand->id()
        );
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $this->searchRequestEmployeeById->execute(
                $changeStatusToDeletedRequestCommand->id()
            ),
            RequestEmployeeStatus::STATUS_DRAFT_DELETED
        );

        return $this->changeStatusToDeletedRequestTransform->transform();
    }
}

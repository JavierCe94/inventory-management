<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeletedRequest;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeStatus;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById;

class ChangeStatusToDeletedRequest
{
    private $requestEmployeeRepository;
    private $changeStatusToDeletedRequestTransform;
    private $searchRequestEmployeeById;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ChangeStatusToDeletedRequestTransformI $changeStatusToDeletedRequestTransform,
        SearchRequestEmployeeById $searchRequestEmployeeById
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->changeStatusToDeletedRequestTransform = $changeStatusToDeletedRequestTransform;
        $this->searchRequestEmployeeById = $searchRequestEmployeeById;
    }

    public function handle(ChangeStatusToDeletedRequestCommand $changeStatusToDeletedRequestCommand): string
    {
        $this->requestEmployeeRepository->changeStatusRequestEmployee(
            $this->searchRequestEmployeeById->execute(
                $changeStatusToDeletedRequestCommand->id()
            ),
            RequestEmployeeStatus::STATUS_DRAFT_DELETED
        );

        return $this->changeStatusToDeletedRequestTransform->transform();
    }
}

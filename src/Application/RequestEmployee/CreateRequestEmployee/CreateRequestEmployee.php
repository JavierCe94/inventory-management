<?php

namespace Inventory\Management\Application\RequestEmployee\CreateRequestEmployee;

use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;

class CreateRequestEmployee
{
    private $requestEmployeeRepository;
    private $createRequestEmployeeTransform;
    private $searchEmployeeByNif;

    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        CreateRequestEmployeeTransformI $createRequestEmployeeTransform,
        SearchEmployeeByNif $searchEmployeeByNif
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->createRequestEmployeeTransform = $createRequestEmployeeTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
    }

    public function handle(CreateRequestEmployeeCommand $createRequestEmployeeCommand)
    {
        $this->requestEmployeeRepository->createRequestEmployee(
            new RequestEmployee(
                $this->searchEmployeeByNif->execute(
                    $createRequestEmployeeCommand->nif()
                )
            )
        );

        return $this->createRequestEmployeeTransform->transform();
    }
}

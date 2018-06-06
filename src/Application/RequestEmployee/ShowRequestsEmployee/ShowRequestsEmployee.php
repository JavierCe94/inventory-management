<?php

namespace Inventory\Management\Application\RequestEmployee\ShowRequestsEmployee;

use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;

class ShowRequestsEmployee
{
    private $requestEmployeeRepository;
    private $showRequestsEmployeeTransform;
    private $searchEmployeeByNif;
    
    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ShowRequestsEmployeeTransformI $showRequestsEmployeeTransform,
        SearchEmployeeByNif $searchEmployeeByNif
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->showRequestsEmployeeTransform = $showRequestsEmployeeTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
    }
    
    public function handle(ShowRequestsEmployeeCommand $showRequestsEmployeeCommand): array
    {
        $this->searchEmployeeByNif->execute(
            $showRequestsEmployeeCommand->nif()
        );

        return $this->showRequestsEmployeeTransform->transform(
            $this->requestEmployeeRepository->showRequestsEmployee(
                $showRequestsEmployeeCommand->nif(),
                $showRequestsEmployeeCommand->status()
            )
        );
    }
}

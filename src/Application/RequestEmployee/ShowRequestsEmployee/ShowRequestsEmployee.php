<?php

namespace Inventory\Management\Application\RequestEmployee\ShowRequestsEmployee;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;

class ShowRequestsEmployee
{
    private $requestEmployeeRepository;
    private $showRequestsEmployeeTransform;
    
    public function __construct(
        RequestEmployeeRepository $requestEmployeeRepository,
        ShowRequestsEmployeeTransformI $showRequestsEmployeeTransform
    ) {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
        $this->showRequestsEmployeeTransform = $showRequestsEmployeeTransform;
    }
    
    public function handle(ShowRequestsEmployeeCommand $showRequestsEmployeeCommand): array
    {
        return $this->showRequestsEmployeeTransform->transform(
            $this->requestEmployeeRepository->showRequestsEmployee(
                $showRequestsEmployeeCommand->nif(),
                $showRequestsEmployeeCommand->status()
            )
        );
    }
}

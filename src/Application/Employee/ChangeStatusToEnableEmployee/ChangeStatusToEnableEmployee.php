<?php

namespace Inventory\Management\Application\Employee\ChangeStatusToEnableEmployee;

use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif;

class ChangeStatusToEnableEmployee
{
    private $employeeRepository;
    private $changeStatusToEnableEmployeeTransform;
    private $searchEmployeeByNif;

    public function __construct(
        EmployeeRepository $employeeRepository,
        ChangeStatusToEnableEmployeeTransformI $changeStatusToEnableEmployeeTransform,
        SearchEmployeeByNif $searchEmployeeByNif
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->changeStatusToEnableEmployeeTransform = $changeStatusToEnableEmployeeTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
    }

    public function handle(ChangeStatusToEnableEmployeeCommand $enableEmployeeCommand): string
    {
        $this->employeeRepository->changeStatusEmployee(
            $this->searchEmployeeByNif->execute(
                $enableEmployeeCommand->nif()
            ),
            false
        );

        return $this->changeStatusToEnableEmployeeTransform->transform();
    }
}

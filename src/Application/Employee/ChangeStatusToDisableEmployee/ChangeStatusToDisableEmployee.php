<?php

namespace Inventory\Management\Application\Employee\ChangeStatusToDisableEmployee;

use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif;

class ChangeStatusToDisableEmployee
{
    private $employeeRepository;
    private $changeStatusToDisableEmployeeTransform;
    private $searchEmployeeByNif;

    public function __construct(
        EmployeeRepository $employeeRepository,
        ChangeStatusToDisableEmployeeTransformI $changeStatusToDisableEmployeeTransform,
        SearchEmployeeByNif $searchEmployeeByNif
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->changeStatusToDisableEmployeeTransform = $changeStatusToDisableEmployeeTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
    }

    public function handle(ChangeStatusToDisableEmployeeCommand $disableEmployeeCommand): string
    {
        $this->employeeRepository->changeStatusEmployee(
            $this->searchEmployeeByNif->execute(
                $disableEmployeeCommand->nif()
            ),
            true
        );

        return $this->changeStatusToDisableEmployeeTransform->transform();
    }
}

<?php

namespace Inventory\Management\Application\Employee\ChangeStatusToEnableEmployee;

use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Service\Employee\SearchEmployeeByNif;

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

    /**
     * @param ChangeStatusToEnableEmployeeCommand $enableEmployeeCommand
     * @return string
     * @throws \Inventory\Management\Domain\Model\Entity\Employee\NotFoundEmployeesException
     */
    public function handle(ChangeStatusToEnableEmployeeCommand $enableEmployeeCommand): string
    {
        $this->employeeRepository->changeStatusToEnableEmployee(
            $this->searchEmployeeByNif->execute(
                $enableEmployeeCommand->nif()
            )
        );

        return $this->changeStatusToEnableEmployeeTransform->transform();
    }
}

<?php

namespace Inventory\Management\Application\Employee\ChangeStatusToDisableEmployee;

use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Service\Employee\SearchEmployeeByNif;

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

    /**
     * @param ChangeStatusToDisableEmployeeCommand $disableEmployeeCommand
     * @return string
     * @throws \Inventory\Management\Domain\Model\Entity\Employee\NotFoundEmployeesException
     */
    public function handle(ChangeStatusToDisableEmployeeCommand $disableEmployeeCommand): string
    {
        $this->employeeRepository->changeStatusToDisableEmployee(
            $this->searchEmployeeByNif->execute(
                $disableEmployeeCommand->nif()
            )
        );

        return $this->changeStatusToDisableEmployeeTransform->transform();
    }
}

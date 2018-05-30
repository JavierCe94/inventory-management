<?php

namespace Inventory\Management\Application\Employee\ShowByFirstResultEmployees;

use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;

class ShowByFirstResultEmployees
{
    private $employeeRepository;
    private $showEmployeesTransform;

    public function __construct(
        EmployeeRepository $employeeRepository,
        ShowByFirstResultEmployeesTransformI $showEmployeesTransform
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->showEmployeesTransform = $showEmployeesTransform;
    }

    public function handle(ShowByFirstResultEmployeesCommand $showEmployeesCommand): array
    {
        return $this->showEmployeesTransform->transform(
            $this->employeeRepository->showByFirstResultFilterEmployees(
                $showEmployeesCommand->firstResultPosition(),
                $showEmployeesCommand->name(),
                $showEmployeesCommand->code(),
                $showEmployeesCommand->department(),
                $showEmployeesCommand->subDepartment()
            )
        );
    }
}

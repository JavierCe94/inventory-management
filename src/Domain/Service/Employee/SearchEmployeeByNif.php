<?php

namespace Inventory\Management\Domain\Service\Employee;

use Inventory\Management\Domain\Model\Entity\Employee\Employee;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\Entity\Employee\NotFoundEmployeesException;
use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif as SearchEmployeeByNifI;

class SearchEmployeeByNif implements SearchEmployeeByNifI
{
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @throws NotFoundEmployeesException
     */
    public function execute(string $nifEmployee): ?Employee
    {
        $resultEmployee = $this->employeeRepository->findEmployeeByNif($nifEmployee);
        if (null === $resultEmployee) {
            throw new NotFoundEmployeesException();
        }

        return $resultEmployee;
    }
}

<?php

namespace Inventory\Management\Domain\Service\Employee;

use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\Entity\Employee\FoundTelephoneEmployeeException;
use Inventory\Management\Domain\Model\Entity\Employee\CheckNotExistTelephoneEmployee as CheckNotExistTelephoneEmployeeI;

class CheckNotExistTelephoneEmployee implements CheckNotExistTelephoneEmployeeI
{
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param string $telephone
     * @param string $nif
     * @throws FoundTelephoneEmployeeException
     */
    public function execute(string $telephone, string $nif): void
    {
        $telephoneEmployee = $this->employeeRepository->checkNotExistsTelephoneEmployee($telephone, $nif);
        if (null !== $telephoneEmployee) {
            throw new FoundTelephoneEmployeeException();
        }
    }
}

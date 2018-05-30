<?php

namespace Inventory\Management\Application\Employee\UpdateBasicFieldsEmployee;

use Inventory\Management\Domain\Model\Entity\Employee\CheckNotExistTelephoneEmployee;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif;
use Inventory\Management\Domain\Model\PasswordHash\EncryptPassword;

class UpdateBasicFieldsEmployee
{
    private $employeeRepository;
    private $updateBasicFieldsEmployeeTransform;
    private $searchEmployeeByNif;
    private $checkNotExistTelephoneEmployee;
    private $encryptPassword;

    public function __construct(
        EmployeeRepository $employeeRepository,
        UpdateBasicFieldsEmployeeTransformI $updateBasicFieldsEmployeeTransform,
        SearchEmployeeByNif $searchEmployeeByNif,
        CheckNotExistTelephoneEmployee $checkNotExistTelephoneEmployee,
        EncryptPassword $encryptPassword
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->updateBasicFieldsEmployeeTransform = $updateBasicFieldsEmployeeTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
        $this->checkNotExistTelephoneEmployee = $checkNotExistTelephoneEmployee;
        $this->encryptPassword = $encryptPassword;
    }

    public function handle(UpdateBasicFieldsEmployeeCommand $updateBasicFieldsEmployeeCommand): string
    {
        $this->checkNotExistTelephoneEmployee->execute(
            $updateBasicFieldsEmployeeCommand->telephone(),
            $updateBasicFieldsEmployeeCommand->dataToken()->nif
        );
        $this->employeeRepository->updateBasicFieldsEmployee(
            $this->searchEmployeeByNif->execute(
                $updateBasicFieldsEmployeeCommand->dataToken()->nif
            ),
            $this->encryptPassword->execute(
                $updateBasicFieldsEmployeeCommand->password()
            ),
            $updateBasicFieldsEmployeeCommand->name(),
            $updateBasicFieldsEmployeeCommand->telephone()
        );

        return $this->updateBasicFieldsEmployeeTransform->transform();
    }
}

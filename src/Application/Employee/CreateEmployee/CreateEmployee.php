<?php

namespace Inventory\Management\Application\Employee\CreateEmployee;

use Inventory\Management\Domain\Model\Entity\Department\SearchSubDepartmentById;
use Inventory\Management\Domain\Model\Entity\Employee\CheckNotExistsUniqueFields;
use Inventory\Management\Domain\Model\Entity\Employee\Employee;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeStatus;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeStatusRepository;
use Inventory\Management\Domain\Model\File\UploadFile;
use Inventory\Management\Domain\Model\PasswordHash\EncryptPassword;

class CreateEmployee
{
    private $employeeRepository;
    private $employeeStatusRepository;
    private $createEmployeeTransform;
    private $searchSubDepartmentById;
    private $checkNotExistsUniqueFields;
    private $encryptPassword;
    private $uploadFile;

    public function __construct(
        EmployeeRepository $employeeRepository,
        EmployeeStatusRepository $employeeStatusRepository,
        CreateEmployeeTransformI $createEmployeeTransform,
        SearchSubDepartmentById $searchSubDepartmentById,
        CheckNotExistsUniqueFields $checkNotExistsUniqueFields,
        EncryptPassword $encryptPassword,
        UploadFile $uploadFile
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->employeeStatusRepository = $employeeStatusRepository;
        $this->createEmployeeTransform = $createEmployeeTransform;
        $this->searchSubDepartmentById = $searchSubDepartmentById;
        $this->checkNotExistsUniqueFields = $checkNotExistsUniqueFields;
        $this->encryptPassword = $encryptPassword;
        $this->uploadFile = $uploadFile;
    }

    public function handle(CreateEmployeeCommand $createEmployeeCommand): string
    {
        $this->checkNotExistsUniqueFields->execute(
            $createEmployeeCommand->nif(),
            $createEmployeeCommand->inSsNumber(),
            $createEmployeeCommand->telephone(),
            $createEmployeeCommand->codeEmployee()
        );
        $subDepartment = $this->searchSubDepartmentById->execute(
            $createEmployeeCommand->subDepartment()
        );
        $employee = new Employee(
            $this->employeeStatusRepository->createEmployeeStatus(
                new EmployeeStatus(
                    $createEmployeeCommand->codeEmployee(),
                    new \DateTime($createEmployeeCommand->firstContractDate()),
                    new \DateTime($createEmployeeCommand->seniorityDate()),
                    $subDepartment->getDepartment(),
                    $subDepartment
                )
            ),
            $this->uploadFile->execute(
                $createEmployeeCommand->image(),
                Employee::URL_IMAGE
            ),
            $createEmployeeCommand->nif(),
            $this->encryptPassword->execute(
                $createEmployeeCommand->password()
            ),
            $createEmployeeCommand->name(),
            $createEmployeeCommand->inSsNumber(),
            $createEmployeeCommand->telephone()
        );
        $this->employeeRepository->createEmployee($employee);

        return $this->createEmployeeTransform->transform();
    }
}

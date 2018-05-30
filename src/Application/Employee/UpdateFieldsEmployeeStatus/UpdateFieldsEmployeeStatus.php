<?php

namespace Inventory\Management\Application\Employee\UpdateFieldsEmployeeStatus;

use Inventory\Management\Domain\Model\Entity\Department\SearchDepartmentById;
use Inventory\Management\Domain\Model\Entity\Department\SearchSubDepartmentById;
use Inventory\Management\Domain\Model\Entity\Employee\Employee;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif;
use Inventory\Management\Domain\Model\File\UploadFile;

class UpdateFieldsEmployeeStatus
{
    private $employeeRepository;
    private $updateFieldsEmployeeStatusTransform;
    private $searchEmployeeByNif;
    private $searchDepartmentById;
    private $searchSubDepartmentById;
    private $uploadFile;

    public function __construct(
        EmployeeRepository $employeeRepository,
        UpdateFieldsEmployeeStatusTransformI $updateFieldsEmployeeStatusTransform,
        SearchEmployeeByNif $searchEmployeeByNif,
        SearchDepartmentById $searchDepartmentById,
        SearchSubDepartmentById $searchSubDepartmentById,
        UploadFile $uploadFile
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->updateFieldsEmployeeStatusTransform = $updateFieldsEmployeeStatusTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
        $this->searchDepartmentById = $searchDepartmentById;
        $this->searchSubDepartmentById = $searchSubDepartmentById;
        $this->uploadFile = $uploadFile;
    }

    public function handle(UpdateFieldsEmployeeStatusCommand $updateFieldsEmployeeStatusCommand): string
    {
        $this->employeeRepository->updateFieldsEmployeeStatus(
            $this->searchEmployeeByNif->execute(
                $updateFieldsEmployeeStatusCommand->nif()
            ),
            $this->uploadFile->execute(
                $updateFieldsEmployeeStatusCommand->image(),
                Employee::URL_IMAGE
            ),
            new \DateTime($updateFieldsEmployeeStatusCommand->expirationContractDate()),
            new \DateTime($updateFieldsEmployeeStatusCommand->possibleRenewal()),
            $updateFieldsEmployeeStatusCommand->availableHolidays(),
            $updateFieldsEmployeeStatusCommand->holidaysPendingToApplyFor(),
            $this->searchDepartmentById->execute(
                $updateFieldsEmployeeStatusCommand->department()
            ),
            $this->searchSubDepartmentById->execute(
                $updateFieldsEmployeeStatusCommand->subDepartment()
            )
        );

        return $this->updateFieldsEmployeeStatusTransform->transform();
    }
}

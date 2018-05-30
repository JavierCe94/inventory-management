<?php

namespace Inventory\Management\Application\Department\CreateDepartment;

use Inventory\Management\Domain\Model\Entity\Department\CheckNotExistNameDepartment;
use Inventory\Management\Domain\Model\Entity\Department\Department;
use Inventory\Management\Domain\Model\Entity\Department\DepartmentRepository;

class CreateDepartment
{
    private $departmentRepository;
    private $createDepartmentTransform;
    private $checkNotExistNameDepartment;

    public function __construct(
        DepartmentRepository $departmentRepository,
        CreateDepartmentTransformI $createDepartmentTransform,
        CheckNotExistNameDepartment $checkNotExistNameDepartment
    ) {
        $this->departmentRepository = $departmentRepository;
        $this->createDepartmentTransform = $createDepartmentTransform;
        $this->checkNotExistNameDepartment = $checkNotExistNameDepartment;
    }

    public function handle(CreateDepartmentCommand $createDepartmentCommand): string
    {
        $this->checkNotExistNameDepartment->execute(
            $createDepartmentCommand->name()
        );
        $this->departmentRepository->createDepartment(
            new Department(
                $createDepartmentCommand->name()
            )
        );

        return $this->createDepartmentTransform->transform();
    }
}

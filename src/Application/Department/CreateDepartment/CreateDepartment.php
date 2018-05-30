<?php

namespace Inventory\Management\Application\Department\CreateDepartment;

use Inventory\Management\Domain\Model\Entity\Department\Department;
use Inventory\Management\Domain\Model\Entity\Department\DepartmentRepository;
use Inventory\Management\Domain\Service\Department\CheckNotExistNameDepartment;

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

    /**
     * @param CreateDepartmentCommand $createDepartmentCommand
     * @return string
     * @throws \Inventory\Management\Domain\Model\Entity\Department\FoundNameDepartmentException
     */
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

<?php

namespace Inventory\Management\Application\Department\UpdateNameDepartment;

use Inventory\Management\Domain\Model\Entity\Department\DepartmentRepository;
use Inventory\Management\Domain\Model\Entity\Department\SearchDepartmentById;

class UpdateNameDepartment
{
    private $departmentRepository;
    private $updateNameDepartmentTransform;
    private $searchDepartmentById;

    public function __construct(
        DepartmentRepository $departmentRepository,
        UpdateNameDepartmentTransformI $updateNameDepartmentTransform,
        SearchDepartmentById $searchDepartmentById
    ) {
        $this->departmentRepository = $departmentRepository;
        $this->updateNameDepartmentTransform = $updateNameDepartmentTransform;
        $this->searchDepartmentById = $searchDepartmentById;
    }

    public function handle(UpdateNameDepartmentCommand $updateNameDepartmentCommand): string
    {
        $this->departmentRepository->updateNameDepartment(
            $this->searchDepartmentById->execute(
                $updateNameDepartmentCommand->department()
            ),
            $updateNameDepartmentCommand->name()
        );

        return $this->updateNameDepartmentTransform->transform();
    }
}

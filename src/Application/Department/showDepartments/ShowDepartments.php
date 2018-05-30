<?php

namespace Inventory\Management\Application\Department\showDepartments;

use Inventory\Management\Domain\Model\Entity\Department\DepartmentRepository;

class ShowDepartments
{
    private $departmentRepository;
    private $showDepartmentsTransform;

    public function __construct(
        DepartmentRepository $departmentRepository,
        ShowDepartmentsTransformI $showDepartmentsTransform
    ) {
        $this->departmentRepository = $departmentRepository;
        $this->showDepartmentsTransform = $showDepartmentsTransform;
    }

    public function handle(): array
    {
        return $this->showDepartmentsTransform->transform(
            $this->departmentRepository->showAllDepartments()
        );
    }
}

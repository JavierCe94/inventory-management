<?php

namespace Inventory\Management\Application\Department\UpdateNameSubDepartment;

use Inventory\Management\Domain\Model\Entity\Department\SearchSubDepartmentById;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartmentRepository;

class UpdateNameSubDepartment
{
    private $subDepartmentRepository;
    private $updateNameSubDepartmentTransform;
    private $searchSubDepartmentById;

    public function __construct(
        SubDepartmentRepository $subDepartmentRepository,
        UpdateNameSubDepartmentTransformI $updateNameSubDepartmentTransform,
        SearchSubDepartmentById $searchSubDepartmentById
    ) {
        $this->subDepartmentRepository = $subDepartmentRepository;
        $this->updateNameSubDepartmentTransform = $updateNameSubDepartmentTransform;
        $this->searchSubDepartmentById = $searchSubDepartmentById;
    }

    public function handle(UpdateNameSubDepartmentCommand $updateNameSubDepartmentCommand): string
    {
        $this->subDepartmentRepository->updateNameSubDepartment(
            $this->searchSubDepartmentById->execute(
                $updateNameSubDepartmentCommand->subDepartment()
            ),
            $updateNameSubDepartmentCommand->name()
        );

        return $this->updateNameSubDepartmentTransform->transform();
    }
}

<?php

namespace Inventory\Management\Application\Department\UpdateNameSubDepartment;

use Inventory\Management\Domain\Model\Entity\Department\SubDepartmentRepository;
use Inventory\Management\Domain\Service\Department\SearchSubDepartmentById;

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

    /**
     * @param UpdateNameSubDepartmentCommand $updateNameSubDepartmentCommand
     * @return string
     * @throws \Inventory\Management\Domain\Model\Entity\Department\NotFoundSubDepartmentsException
     */
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

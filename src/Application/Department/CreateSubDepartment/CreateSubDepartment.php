<?php

namespace Inventory\Management\Application\Department\CreateSubDepartment;

use Inventory\Management\Domain\Model\Entity\Department\CheckNotExistNameSubDepartment;
use Inventory\Management\Domain\Model\Entity\Department\SearchDepartmentById;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartment;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartmentRepository;

class CreateSubDepartment
{
    private $subDepartmentRepository;
    private $createSubDepartmentTransform;
    private $searchDepartmentById;
    private $checkNotExistNameSubDepartment;

    public function __construct(
        SubDepartmentRepository $subDepartmentRepository,
        CreateSubDepartmentTransformI $createSubDepartmentTransform,
        SearchDepartmentById $searchDepartmentById,
        CheckNotExistNameSubDepartment $checkNotExistNameSubDepartment
    ) {
        $this->subDepartmentRepository = $subDepartmentRepository;
        $this->createSubDepartmentTransform = $createSubDepartmentTransform;
        $this->searchDepartmentById = $searchDepartmentById;
        $this->checkNotExistNameSubDepartment = $checkNotExistNameSubDepartment;
    }

    public function handle(CreateSubDepartmentCommand $createSubDepartmentCommand): string
    {
        $this->checkNotExistNameSubDepartment->execute(
            $createSubDepartmentCommand->name()
        );
        $this->subDepartmentRepository->createSubDepartment(
            $subDepartment = new SubDepartment(
                $this->searchDepartmentById->execute(
                    $createSubDepartmentCommand->department()
                ),
                $createSubDepartmentCommand->name()
            )
        );

        return $this->createSubDepartmentTransform->transform();
    }
}

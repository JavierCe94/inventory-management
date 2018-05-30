<?php

namespace Inventory\Management\Application\Department\CreateSubDepartment;

use Inventory\Management\Domain\Model\Entity\Department\SubDepartment;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartmentRepository;
use Inventory\Management\Domain\Service\Department\CheckNotExistNameSubDepartment;
use Inventory\Management\Domain\Service\Department\SearchDepartmentById;

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

    /**
     * @param CreateSubDepartmentCommand $createSubDepartmentCommand
     * @return string
     * @throws \Inventory\Management\Domain\Model\Entity\Department\FoundNameSubDepartmentException
     * @throws \Inventory\Management\Domain\Model\Entity\Department\NotFoundDepartmentsException
     */
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

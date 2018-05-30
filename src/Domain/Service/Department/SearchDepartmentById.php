<?php

namespace Inventory\Management\Domain\Service\Department;

use Inventory\Management\Domain\Model\Entity\Department\Department;
use Inventory\Management\Domain\Model\Entity\Department\DepartmentRepository;
use Inventory\Management\Domain\Model\Entity\Department\NotFoundDepartmentsException;
use Inventory\Management\Domain\Model\Entity\Department\SearchDepartmentById as SearchDepartmentByIdI;

class SearchDepartmentById implements SearchDepartmentByIdI
{
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @param int $department
     * @return Department|null
     * @throws NotFoundDepartmentsException
     */
    public function execute(int $department): ?Department
    {
        $department = $this->departmentRepository->findDepartmentById($department);
        if (null === $department) {
            throw new NotFoundDepartmentsException();
        }

        return $department;
    }
}

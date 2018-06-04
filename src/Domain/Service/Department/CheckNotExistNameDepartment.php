<?php

namespace Inventory\Management\Domain\Service\Department;

use Inventory\Management\Domain\Model\Entity\Department\DepartmentRepository;
use Inventory\Management\Domain\Model\Entity\Department\FoundNameDepartmentException;
use Inventory\Management\Domain\Model\Entity\Department\CheckNotExistNameDepartment as CheckNotExistNameDepartmentI;

class CheckNotExistNameDepartment implements CheckNotExistNameDepartmentI
{
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @throws FoundNameDepartmentException
     */
    public function execute(string $name): void
    {
        $department = $this->departmentRepository->checkNotExistNameDepartment($name);
        if (null !== $department) {
            throw new FoundNameDepartmentException();
        }
    }
}

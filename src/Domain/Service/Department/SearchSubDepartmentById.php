<?php

namespace Inventory\Management\Domain\Service\Department;

use Inventory\Management\Domain\Model\Entity\Department\NotFoundSubDepartmentsException;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartment;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartmentRepository;
use Inventory\Management\Domain\Model\Entity\Department\SearchSubDepartmentById as SearchSubDepartmentByIdI;

class SearchSubDepartmentById implements SearchSubDepartmentByIdI
{
    private $subDepartmentRepository;

    public function __construct(SubDepartmentRepository $subDepartmentRepository)
    {
        $this->subDepartmentRepository = $subDepartmentRepository;
    }

    /**
     * @throws NotFoundSubDepartmentsException
     */
    public function execute(int $subDepartment): ?SubDepartment
    {
        $subDepartment = $this->subDepartmentRepository->findSubDepartmentById($subDepartment);
        if (null === $subDepartment) {
            throw new NotFoundSubDepartmentsException();
        }

        return $subDepartment;
    }
}

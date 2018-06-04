<?php

namespace Inventory\Management\Infrastructure\Repository\Department;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\Department\Department;
use Inventory\Management\Domain\Model\Entity\Department\DepartmentRepository as DepartmentRepositoryI;

class DepartmentRepository extends ServiceEntityRepository implements DepartmentRepositoryI
{
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createDepartment(Department $department): Department
    {
        $this->getEntityManager()->persist($department);
        $this->getEntityManager()->flush();

        return $department;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateNameDepartment(Department $department, string $name): Department
    {
        $department->setName($name);
        $this->getEntityManager()->flush();

        return $department;
    }

    /**
     * @return object|Department
     */
    public function findDepartmentById(int $idDepartment): ?Department
    {
        return $this->find($idDepartment);
    }

    public function showAllDepartments(): array
    {
        return $this->findAll();
    }

    /**
     * @return object|Department
     */
    public function checkNotExistNameDepartment($name): ?Department
    {
        return $this->findOneBy(['name' => $name]);
    }
}

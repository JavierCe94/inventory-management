<?php

namespace Inventory\Management\Infrastructure\Repository\Department;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartment;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartmentRepository as SubDepartmentRepositoryI;

class SubDepartmentRepository extends ServiceEntityRepository implements SubDepartmentRepositoryI
{
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createSubDepartment(SubDepartment $subDepartment): SubDepartment
    {
        $this->getEntityManager()->persist($subDepartment);
        $this->getEntityManager()->flush();

        return $subDepartment;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateNameSubDepartment(SubDepartment $subDepartment, string $name): SubDepartment
    {
        $subDepartment->setName($name);
        $this->getEntityManager()->flush();

        return $subDepartment;
    }

    /**
     * @return object|SubDepartment
     */
    public function findSubDepartmentById(int $idSubDepartment): ?SubDepartment
    {
        return $this->find($idSubDepartment);
    }

    /**
     * @return object|SubDepartment
     */
    public function checkNotExistNameSubDepartment($name): ?SubDepartment
    {
        return $this->findOneBy(['name' => $name]);
    }
}

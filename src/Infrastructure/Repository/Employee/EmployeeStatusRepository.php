<?php

namespace Inventory\Management\Infrastructure\Repository\Employee;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeStatus;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeStatusRepository as EmployeeStatusRepositoryI;

class EmployeeStatusRepository extends ServiceEntityRepository implements EmployeeStatusRepositoryI
{
    /**
     * @param EmployeeStatus $employeeStatus
     * @return EmployeeStatus
     * @throws \Doctrine\ORM\ORMException
     */
    public function createEmployeeStatus(EmployeeStatus $employeeStatus): EmployeeStatus
    {
        $this->getEntityManager()->persist($employeeStatus);

        return $employeeStatus;
    }

    /**
     * @param string $codeEmployee
     * @return object|EmployeeStatus
     */
    public function checkNotExistsCodeEmployeeStatus(string $codeEmployee): ?EmployeeStatus
    {
        return $this->findOneBy(['codeEmployee' => $codeEmployee]);
    }
}

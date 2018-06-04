<?php

namespace Inventory\Management\Infrastructure\Repository\Employee;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\Department\Department;
use Inventory\Management\Domain\Model\Entity\Department\SubDepartment;
use Inventory\Management\Domain\Model\Entity\Employee\Employee;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository as EmployeeRepositoryI;
use Inventory\Management\Infrastructure\Util\Specification\AndX;
use Inventory\Management\Infrastructure\Util\Specification\AsArray;
use Inventory\Management\Infrastructure\Util\Specification\Employee\FilterEmployeeByCode;
use Inventory\Management\Infrastructure\Util\Specification\Employee\FilterEmployeeByDepartment;
use Inventory\Management\Infrastructure\Util\Specification\Employee\FilterEmployeeByName;
use Inventory\Management\Infrastructure\Util\Specification\Employee\FilterEmployeeBySubDepartment;

class EmployeeRepository extends ServiceEntityRepository implements EmployeeRepositoryI
{
    private const MAX_RESULTS_QUERY = 20;

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createEmployee(Employee $employee): Employee
    {
        $this->getEntityManager()->persist($employee);
        $this->getEntityManager()->flush();

        return $employee;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeStatusEmployee(Employee $employee, bool $isDisabled): Employee
    {
        $employee->getEmployeeStatus()->setDisabledEmployee($isDisabled);
        $this->getEntityManager()->flush();

        return $employee;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateBasicFieldsEmployee(
        Employee $employee,
        string $passwordHash,
        string $name,
        string $telephone
    ): Employee {
        $employee->setPassword($passwordHash);
        $employee->setName($name);
        $employee->setTelephone($telephone);
        $this->getEntityManager()->flush();

        return $employee;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateFieldsEmployeeStatus(
        Employee $employee,
        string $image,
        \DateTime $expirationContractDate,
        \DateTime $possibleRenewal,
        int $availableHolidays,
        int $holidaysPendingToApplyFor,
        Department $department,
        SubDepartment $subDepartment
    ): Employee {
        $employee->setImage($image);
        $employeeStatus = $employee->getEmployeeStatus();
        $employeeStatus->setExpirationContractDate($expirationContractDate);
        $employeeStatus->setPossibleRenewal($possibleRenewal);
        $employeeStatus->setAvailableHolidays($availableHolidays);
        $employeeStatus->setHolidaysPendingToApplyFor($holidaysPendingToApplyFor);
        $employeeStatus->setDepartment($department);
        $employeeStatus->setSubDepartment($subDepartment);
        $this->getEntityManager()->flush();

        return $employee;
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findEmployeeByNif(string $nif): ?Employee
    {
        return $this->createQueryBuilder('em')
            ->innerJoin('em.employeeStatus', 'ems')
            ->andWhere('em.nif = :nif')
            ->andWhere('ems.disabledEmployee = :disabledEmployee')
            ->setParameter('nif', $nif)
            ->setParameter('disabledEmployee', false)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function showByFirstResultFilterEmployees(
        int $initialResult,
        $name,
        $code,
        $department,
        $subDepartment
    ): array {
        $query = $this->createQueryBuilder('em')
            ->innerJoin('em.employeeStatus', 'ems')
            ->setFirstResult($initialResult)
            ->setMaxResults(self::MAX_RESULTS_QUERY);
        $specification = new AsArray(
            new AndX(
                new FilterEmployeeByName($name),
                new FilterEmployeeByCode($code),
                new FilterEmployeeByDepartment($department),
                new FilterEmployeeBySubDepartment($subDepartment)
            )
        );
        $specification->match($query);

        return $query->getQuery()->execute();
    }

    /**
     * @return object|Employee
     */
    public function checkNotExistsInSsNumberEmployee(string $inSsNumber): ?Employee
    {
        return $this->findOneBy(['inSsNumber' => $inSsNumber]);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkNotExistsTelephoneEmployee(string $telephone, string $nif): ?Employee
    {
        return $this->createQueryBuilder('em')
            ->andWhere('em.telephone = :telephone')
            ->andWhere('em.nif != :nif')
            ->setParameter('telephone', $telephone)
            ->setParameter('nif', $nif)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

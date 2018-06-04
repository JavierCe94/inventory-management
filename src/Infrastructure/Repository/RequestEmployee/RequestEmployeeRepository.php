<?php

namespace Inventory\Management\Infrastructure\Repository\RequestEmployee;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository as RequestEmployeeRepositoryI;
use Inventory\Management\Infrastructure\Util\Specification\AndX;
use Inventory\Management\Infrastructure\Util\Specification\AsArray;
use Inventory\Management\Infrastructure\Util\Specification\RequestEmployee\FilterRequestsEmployeeByState;

class RequestEmployeeRepository extends ServiceEntityRepository implements RequestEmployeeRepositoryI
{
    /**
     * @param RequestEmployee $requestEmployee
     * @return RequestEmployee
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createRequestEmployee(RequestEmployee $requestEmployee): RequestEmployee
    {
        $this->getEntityManager()->persist($requestEmployee);
        $this->getEntityManager()->flush();

        return $requestEmployee;
    }

    /**
     * @param RequestEmployee $requestEmployee
     * @param string $status
     * @return RequestEmployee
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeStatusRequestEmployee(RequestEmployee $requestEmployee, string $status): RequestEmployee
    {
        $requestEmployee->setStatus($status);
        $requestEmployee->setDateModification(new \DateTime());
        $this->getEntityManager()->flush();

        return $requestEmployee;
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkRequestIsFromEmployee(string $nifEmployee, int $idRequestEmployee): ?RequestEmployee
    {
        return $this->createQueryBuilder('re')
            ->innerJoin('re.employee', 'em')
            ->andWhere('em.nif = :nifEmployee')
            ->andWhere('re.id = :idRequestEmployee')
            ->setParameter('nifEmployee', $nifEmployee)
            ->setParameter('idRequestEmployee', $idRequestEmployee)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param int $id
     * @return object|RequestEmployee
     */
    public function findRequestEmployeeById(int $id): ?RequestEmployee
    {
        return $this->find($id);
    }

    public function showRequestsEmployee(string $nif, ?string $status): array
    {
        $query = $this->createQueryBuilder('re')
            ->innerJoin('re.employee', 'em')
            ->andWhere('em.nif = :nif')
            ->setParameter('nif', $nif);
        $specification = new AsArray(
            new AndX(
                new FilterRequestsEmployeeByState($status)
            )
        );
        $specification->match($query);

        return $query->getQuery()->execute();
    }
}

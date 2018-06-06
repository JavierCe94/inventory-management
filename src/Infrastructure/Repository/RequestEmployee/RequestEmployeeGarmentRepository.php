<?php

namespace Inventory\Management\Infrastructure\Repository\RequestEmployee;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarment;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository
    as RequestEmployeeGarmentRepositoryI;

class RequestEmployeeGarmentRepository extends ServiceEntityRepository implements RequestEmployeeGarmentRepositoryI
{
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createRequestEmployeeGarments(array $requestEmployeeGarments): array
    {
        foreach ($requestEmployeeGarments as $requestEmployeeGarment) {
            $this->getEntityManager()->persist($requestEmployeeGarment);
        }
        $this->getEntityManager()->flush();

        return $requestEmployeeGarments;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeStateRequestEmployeeGarment(
        RequestEmployeeGarment $requestEmployeeGarment,
        bool $isDeleted
    ): RequestEmployeeGarment {
        $requestEmployeeGarment->setIsDeleted($isDeleted);
        $this->getEntityManager()->flush();

        return $requestEmployeeGarment;
    }

    /**
     * @return object|RequestEmployeeGarment
     */
    public function findRequestEmployeeGarmentById(int $idRequestGarment): ?RequestEmployeeGarment
    {
        return $this->find($idRequestGarment);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function checkRequestGarmentIsFromEmployee(
        string $nifEmployee,
        int $idRequestGarment
    ): ?RequestEmployeeGarment {
        return $this->createQueryBuilder('reg')
            ->innerJoin('reg.requestEmployee', 're')
            ->innerJoin('re.employee', 'em')
            ->andWhere('em.nif = :nifEmployee')
            ->andWhere('reg.id = :idRequestGarment')
            ->setParameter('nifEmployee', $nifEmployee)
            ->setParameter('idRequestGarment', $idRequestGarment)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function showRequestEmployeeGarments(
        string $nifEmployee,
        int $idRequestEmployee,
        bool $showDeletes
    ): array {
        return $this->createQueryBuilder('reg')
            ->innerJoin('reg.requestEmployee', 're')
            ->innerJoin('re.employee', 'em')
            ->andWhere('em.nif = :nifEmployee')
            ->andWhere('re.id = :idRequestEmployee')
            ->andWhere('reg.isDeleted = :isDeleted')
            ->setParameter('nifEmployee', $nifEmployee)
            ->setParameter('idRequestEmployee', $idRequestEmployee)
            ->setParameter('isDeleted', $showDeletes)
            ->getQuery()
            ->execute();
    }
}

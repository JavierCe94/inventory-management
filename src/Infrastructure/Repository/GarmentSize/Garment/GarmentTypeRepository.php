<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize\Garment;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository as GarmentTypeRepositoryI;

class GarmentTypeRepository extends ServiceEntityRepository implements GarmentTypeRepositoryI
{
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertGarmentType(GarmentType $garmentType): GarmentType
    {
        $this->getEntityManager()->persist($garmentType);
        $this->getEntityManager()->flush();

        return $garmentType;
    }

    public function listGarmentTypes(): array
    {
        return $this->findAll();
    }

    public function findGarmentTypeById(int $id): ?GarmentType
    {
        /* @var GarmentType $garmentTypeEntity */
        $garmentTypeEntity = $this->findOneBy(['id' => $id]);

        return $garmentTypeEntity;
    }

    public function findGarmentTypeByName(string $name): ?GarmentType
    {
        /* @var GarmentType $query */
        $query = $this->findOneBy(["name" => $name]);

        return $query;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateGarmentType(GarmentType $garmentType, string $name): GarmentType
    {
        $garmentType->setName($name);
        $this->getEntityManager()->flush();

        return $garmentType;
    }
}

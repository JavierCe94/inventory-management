<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize\Garment;

use Doctrine\ORM\EntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class GarmentTypeRepository extends EntityRepository implements GarmentTypeRepositoryInterface
{
    public function insertGarmentType(string $name): GarmentType
    {
        $garmentTypeEntity = new GarmentType();
        $garmentTypeEntity->setName($name);

        return $garmentTypeEntity;
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
    public function updateGarmentType(GarmentType $garmentTypeEntity, string $name): void
    {
        $garmentTypeEntity->setName($name);
        $this->persistAndFlush($garmentTypeEntity);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(GarmentType $garmentTypeEntity): void
    {
        $this->getEntityManager()->persist($garmentTypeEntity);
        $this->getEntityManager()->flush();
    }
}

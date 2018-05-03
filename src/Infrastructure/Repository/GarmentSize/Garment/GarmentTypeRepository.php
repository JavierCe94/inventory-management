<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize\Garment;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class GarmentTypeRepository extends ServiceEntityRepository implements GarmentTypeRepositoryInterface
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

    /**
     * @param int $id
     *
     * @return GarmentType
     */
    public function findGarmentTypeById(int $id): ?GarmentType
    {
        return $this->findOneBy(["id" => $id]);
    }

    public function findGarmentTypeByName(string $name): ?GarmentType
    {
        return $this->findOneBy(["name" => $name]);
    }

    public function updateGarmentType(GarmentType $garmentTypeEntity, string $name): void
    {
        $garmentTypeEntity->setName($name);
        $this->persistAndFlush($garmentTypeEntity);
    }

    public function persistAndFlush(GarmentType $garmentTypeEntity): void
    {
        $this->getEntityManager()->persist($garmentTypeEntity);
        $this->getEntityManager()->flush();
    }
}

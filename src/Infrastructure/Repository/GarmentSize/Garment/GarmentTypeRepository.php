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

    public function findGarmentTypeById(int $id): GarmentType
    {
        $garmentTypeEntity = $this->findOneBy(['id' => $id]);
        return $garmentTypeEntity;
    }

    public function persistAndFlush(GarmentType $garmentTypeEntity): void
    {
        $this->getEntityManager()->persist($garmentTypeEntity);
        $this->getEntityManager()->flush();
    }
}

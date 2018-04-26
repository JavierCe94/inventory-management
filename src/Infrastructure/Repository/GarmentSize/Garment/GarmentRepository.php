<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize\Garment;

use Doctrine\ORM\EntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;

class GarmentRepository extends EntityRepository implements GarmentRepositoryInterface
{
    public function insertGarment(string $name, GarmentType $garmentTypeId): Garment
    {
        $garmentEntity = new Garment();
        $garmentEntity->setName($name);
        $garmentEntity->setGarmentType($garmentTypeId);
        return $garmentEntity;
    }

    public function listGarment(): array
    {
        return $this->findAll();
    }

    public function persistAndFlush(Garment $garmentEntity): void
    {
        $this->getEntityManager()->persist($garmentEntity);
        $this->getEntityManager()->flush();
    }
}

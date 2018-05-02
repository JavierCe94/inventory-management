<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize\Garment;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;

class GarmentRepository extends ServiceEntityRepository implements GarmentRepositoryInterface
{
    public function insertGarment(string $name, GarmentType $garmentTypeId): ?Garment
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

    public function updateGarment(Garment $garmentEntity, string $name):void
    {
        $garmentEntity->setName($name);
        $this->persistAndFlush($garmentEntity);
    }

    public function findGarmentById(int $id): ?Garment
    {
        return $this->findOneBy(["id" => $id]);
    }

    public function persistAndFlush(Garment $garmentEntity): void
    {
        $this->getEntityManager()->persist($garmentEntity);
        $this->getEntityManager()->flush();
    }
}

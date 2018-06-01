<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository as GarmentSizeRepositoryI;

class GarmentSizeRepository extends ServiceEntityRepository implements GarmentSizeRepositoryI
{
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createGarmentSize(GarmentSize $garmentSize): GarmentSize
    {
        $this->getEntityManager()->persist($garmentSize);
        $this->getEntityManager()->flush();

        return $garmentSize;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateStockGarmentSize(GarmentSize $garmentSize, int $stock): GarmentSize
    {
        $garmentSize->setStock($stock);
        $this->getEntityManager()->flush();

        return $garmentSize;
    }

    public function findAllGarmentSize(): array
    {
        return $this->findAll();
    }

    /**
     * @return object|GarmentSize
     */
    public function findByGarmentAndSizeId(int $size, int $garment): ?GarmentSize
    {
        return $this->findOneBy([
            "size" => $size,
            "garment" => $garment
        ]);
    }
}

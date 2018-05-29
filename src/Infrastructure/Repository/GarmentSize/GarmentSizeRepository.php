<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize;

use Doctrine\ORM\EntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;

class GarmentSizeRepository extends EntityRepository implements GarmentSizeRepositoryInterface
{
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(GarmentSize $garmentSize)
    {
        $this->getEntityManager()->persist($garmentSize);
        $this->getEntityManager()->flush();
    }

    public function findAllGarmentSize()
    {
        return $this->findAll();
    }

    public function findByGarmentAndSizeId(int $size, int $garment): ?GarmentSize
    {
        /* @var GarmentSize $query */
        $query = $this->findOneBy([
            "size" => $size,
            "garment" => $garment
        ]);

        return $query;
    }
}

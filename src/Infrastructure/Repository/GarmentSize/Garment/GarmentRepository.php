<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize\Garment;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepository as GarmentRepositoryI;

class GarmentRepository extends ServiceEntityRepository implements GarmentRepositoryI
{
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertGarment(Garment $garment): Garment
    {
        $this->getEntityManager()->persist($garment);
        $this->getEntityManager()->flush();

        return $garment;
    }

    public function listGarment(): array
    {
        return $this->findAll();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateGarment(Garment $garment, string $name): Garment
    {
        $garment->setName($name);
        $this->getEntityManager()->flush();
        
        return $garment;
    }

    public function findGarmentByName(string $name): ?Garment
    {
        /* @var Garment $query */
        $query = $this->findOneBy(["name" => $name]);

        return $query;
    }

    public function findGarmentById(int $id): ?Garment
    {
        /* @var Garment $query */
        $query = $this->findOneBy(["id" => $id]);

        return $query;
    }
}

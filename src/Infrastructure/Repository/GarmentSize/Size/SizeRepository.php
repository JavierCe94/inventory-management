<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize\Size;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository as SizeRepositoryI;

class SizeRepository extends ServiceEntityRepository implements SizeRepositoryI
{
    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addSize(Size $size): Size
    {
        $this->getEntityManager()->persist($size);
        $this->getEntityManager()->flush();

        return $size;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateSize(Size $size, string $sizeValue): Size
    {
        $size->setSizeValue($sizeValue);
        $this->getEntityManager()->flush();

        return $size;
    }

    public function findAllSize(): array
    {
        return $this->findAll();
    }

    /**
     * @return object|Size
     */
    public function findSizeBySizeValueAndGarmentType(string $sizeValue, int $garmentTypeId): ?Size
    {
        return $this->findOneBy([
            'sizeValue' => $sizeValue,
            'garmentType' => $garmentTypeId
        ]);
    }
    
    public function findByGarmentType(int $garmentTypeId): array
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('size.sizeValue')
            ->from('Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size', 'size')
            ->Where('size.garmentType = :garmentTypeId')
            ->setParameter('garmentTypeId', $garmentTypeId)
            ->getQuery()
            ->execute();
    }
}

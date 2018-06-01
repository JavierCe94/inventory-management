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
    public function updateSize(Size $size, $sizeValue): Size
    {
        $size->setSizeValue($sizeValue);
        $this->getEntityManager()->flush();

        return $size;
    }

    public function findAllSize(): array
    {
        return $this->findAll();
    }

    public function findSizeBySizeValueAndGarmentType($sizeValue, $garmentTypeId): ?Size
    {
        /* @var Size $query */
        $query = $this->findOneBy([
            'sizeValue' => $sizeValue,
            'garmentType' => $garmentTypeId
        ]);

        return $query;
    }
    
    public function findByGarmentType($garmentTypeId): array
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('size.sizeValue')
            ->from('Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size', 'size')
            ->Where('size.garmentType = :garmentTypeId')
            ->setParameter('garmentTypeId', $garmentTypeId)
            ->getQuery()
            ->execute();

        return $query;
    }
}

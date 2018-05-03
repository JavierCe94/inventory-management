<?php

namespace Inventory\Management\Infrastructure\Repository\GarmentSize\Size;

use Doctrine\ORM\EntityRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;

class SizeRepository extends EntityRepository implements SizeRepositoryInterface
{
    /**
     * @param Size $size
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(Size $size)
    {

        $this->getEntityManager()->persist($size);
        $this->getEntityManager()->flush();
    }

    public function addSize($sizeValue, $garmentType): Size
    {
        $size = new Size();
        $size->setSizeValue($sizeValue);
        $size->setGarmentType($garmentType);

        return $size;
    }

    public function updateSize($sizeValue, Size $size): Size
    {
        $size->setSizeValue($sizeValue);

        return $size;
    }

    public function findAllSize()
    {
        return $this->findAll();
    }

    public function findSizeBySizeValueAndGarmentType($sizeValue, $garmentTypeId)
    {
//        $query = $this->getEntityManager()->createQueryBuilder()
//            ->select('size.id', 'size.sizeValue', 'size.garmentType')
//            ->from('Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size', 'size')
//            ->Where('size.sizeValue = :sizeValue')
//            ->andWhere('size.garmentType = :garmentTypeId')
//            ->setParameter('sizeValue', $sizeValue)
//            ->setParameter('garmentTypeId', $garmentTypeId)
//            ->getQuery()
//            ->execute();
        $query = $this->findBy(
            [
                'sizeValue' => $sizeValue,
                'garmentType' => $garmentTypeId
            ]
        );

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

//      $query = $this->getEntityManager()->createQueryBuilder()
//            ->select('size.sizeValue')
//            ->from('Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size', 'size')
//            ->innerJoin(
//                'Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType',
//                'gt'
//            )
//            ->where('gt.name = :garmentTypeName')
//            ->setParameter('garmentTypeName', $garmentTypeName)
//            ->getQuery()
//            ->execute();

        return $query;
    }

}

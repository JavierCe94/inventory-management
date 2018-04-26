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


}

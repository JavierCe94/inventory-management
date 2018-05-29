<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Size;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeAlreadyExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;

class CheckIfSizeEntityExist
{
    private $sizeRepository;
    
    public function __construct(SizeRepositoryInterface $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    /**
     * @param int $id
     * @param int $sizeValue
     * @throws SizeAlreadyExist
     */
    public function check(int $id, int $sizeValue)
    {
        $output = $this->sizeRepository->findSizeBySizeValueAndGarmentType($sizeValue, $id);
        if (null !== $output) {
            throw new SizeAlreadyExist();
        }
    }
}

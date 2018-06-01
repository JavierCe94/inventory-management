<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Size;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeAlreadyExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\CheckIfSizeEntityExist as CheckIfSizeEntityExistI;

class CheckIfSizeEntityExist implements CheckIfSizeEntityExistI
{
    private $sizeRepository;
    
    public function __construct(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    /**
     * @throws SizeAlreadyExist
     */
    public function execute(int $id, int $sizeValue)
    {
        $output = $this->sizeRepository->findSizeBySizeValueAndGarmentType($sizeValue, $id);
        if (null !== $output) {
            throw new SizeAlreadyExist();
        }
    }
}

<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeAlreadyExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryI;

class CheckGarmentSizeExist implements CheckGarmentSizeExistI
{
    private $garmentSizeRepository;
    
    public function __construct(GarmentSizeRepositoryI $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
    }

    /**
     * @throws GarmentSizeAlreadyExist
     */
    public function __invoke($size, $garment): ?GarmentSize
    {
        $output =  $this->garmentSizeRepository->findByGarmentAndSizeId($size, $garment);
        if (null !== $output) {
            throw new GarmentSizeAlreadyExist();
        }

        return $output;
    }
}

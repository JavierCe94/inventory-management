<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeAlreadyExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;

class CheckGarmentSizeExist
{
    private $garmentSizeRepository;
    
    public function __construct(GarmentSizeRepositoryInterface $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
    }

    /**
     * @param $size
     * @param $garment
     * @return GarmentSize|null
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

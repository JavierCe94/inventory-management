<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryI;

class FindGarmentSizeIfExist implements  FindGarmentSizeIfExistI
{
    private $garmentSizeRepository;

    public function __construct(GarmentSizeRepositoryI $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
    }

    /**
     * @throws GarmentSizeNotExist
     */
    public function __invoke($size, $garment): ?GarmentSize
    {
        $output =  $this->garmentSizeRepository->findByGarmentAndSizeId($size, $garment);
        if (null === $output) {
            throw new GarmentSizeNotExist();
        }

        return $output;
    }
}

<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\FindGarmentSizeIfExist as FindGarmentSizeIfExistI;

class FindGarmentSizeIfExist implements  FindGarmentSizeIfExistI
{
    private $garmentSizeRepository;

    public function __construct(GarmentSizeRepository $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
    }

    /**
     * @throws GarmentSizeNotExist
     */
    public function execute($size, $garment): ?GarmentSize
    {
        $output =  $this->garmentSizeRepository->findByGarmentAndSizeId($size, $garment);
        if (null === $output) {
            throw new GarmentSizeNotExist();
        }

        return $output;
    }
}

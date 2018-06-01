<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentTypeIfExists as FindGarmentTypeIfExistsI;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;

class FindGarmentTypeIfExists implements FindGarmentTypeIfExistsI
{
    private $garmentTypeRepository;

    public function __construct(GarmentTypeRepository $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
    }

    /**
     * @throws GarmentTypeNotExistsException
     */
    public function execute(int $id): GarmentType
    {
        $output = $this->garmentTypeRepository->findGarmentTypeById($id);
        if (null === $output) {
            throw new GarmentTypeNotExistsException();
        }
        
        return $output;
    }
}

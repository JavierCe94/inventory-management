<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExists as GarmentTypeNameExistsI;

class GarmentTypeNameExists implements GarmentTypeNameExistsI
{
    private $garmentTypeRepository;

    public function __construct(GarmentTypeRepository $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
    }

    /**
     * @throws GarmentTypeNameExistsException
     */
    public function execute(string $name)
    {
        $output = $this->garmentTypeRepository->findGarmentTypeByName($name);
        if (null !== $output) {
            throw new GarmentTypeNameExistsException();
        }
        
        return $output;
    }
}

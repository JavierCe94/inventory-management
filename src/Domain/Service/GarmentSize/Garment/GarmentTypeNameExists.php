<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryI;

class GarmentTypeNameExists implements GarmentTypeNameExistsI
{
    private $garmentTypeRepository;

    public function __construct(GarmentTypeRepositoryI $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
    }

    /**
     * @throws GarmentTypeNameExistsException
     */
    public function check(string $name)
    {
        $output = $this->garmentTypeRepository->findGarmentTypeByName($name);
        if (null !== $output) {
            throw new GarmentTypeNameExistsException();
        }
        
        return $output;
    }
}

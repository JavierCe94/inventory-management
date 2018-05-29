<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class GarmentTypeNameExists
{
    private $garmentTypeRepository;

    public function __construct(GarmentTypeRepositoryInterface $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
    }

    /**
     * @param string $name
     * @return \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType|null
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

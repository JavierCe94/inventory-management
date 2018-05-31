<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryI;

class GarmentNameExists implements GarmentNameExistI
{
    private $garmentRepository;

    public function __construct(GarmentRepositoryI $garmentRepository)
    {
        $this->garmentRepository = $garmentRepository;
    }

    /**
     * @throws GarmentNameExistsException
     */
    public function check(string $name): void
    {
        $output = $this->garmentRepository->findGarmentByName($name);
        if (null !== $output) {
            throw new GarmentNameExistsException();
        }
    }
}

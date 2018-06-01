<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExists as GarmentNameExistsI;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepository;

class GarmentNameExists implements GarmentNameExistsI
{
    private $garmentRepository;

    public function __construct(GarmentRepository $garmentRepository)
    {
        $this->garmentRepository = $garmentRepository;
    }

    /**
     * @throws GarmentNameExistsException
     */
    public function execute(string $name): void
    {
        $output = $this->garmentRepository->findGarmentByName($name);
        if (null !== $output) {
            throw new GarmentNameExistsException();
        }
    }
}

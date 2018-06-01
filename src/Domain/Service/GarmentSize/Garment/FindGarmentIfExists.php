<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentIfExists as FindGarmentIfExistsI;

class FindGarmentIfExists implements FindGarmentIfExistsI
{
    private $garmentRepository;

    public function __construct(GarmentRepository $garmentRepository)
    {
        $this->garmentRepository = $garmentRepository;
    }

    /**
     * @throws GarmentNotExistsException
     */
    public function execute(int $id): ?Garment
    {
        $output = $this->garmentRepository->findGarmentById($id);
        if (null === $output) {
            throw new GarmentNotExistsException();
        }
        
        return $output;
    }
}

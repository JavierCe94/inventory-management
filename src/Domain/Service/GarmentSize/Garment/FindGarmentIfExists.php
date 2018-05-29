<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;

class FindGarmentIfExists
{
    private $garmentRepository;

    public function __construct(GarmentRepositoryInterface $garmentRepository)
    {
        $this->garmentRepository = $garmentRepository;
    }

    /**
     * @param int $id
     * @return Garment|null
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

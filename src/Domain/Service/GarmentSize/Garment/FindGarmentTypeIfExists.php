<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class FindGarmentTypeIfExists
{
    private $garmentTypeRepository;

    public function __construct(GarmentTypeRepositoryInterface $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
    }

    /**
     * @param int $id
     * @return GarmentType|null
     * @throws GarmentTypeNotExistsException
     */
    public function execute(int $id): ?GarmentType
    {
        $output = $this->garmentTypeRepository->findGarmentTypeById($id);
        if (null === $output) {
            throw new GarmentTypeNotExistsException();
        }
        
        return $output;
    }
}

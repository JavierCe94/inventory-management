<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class ListGarmentTypes
{
    private $garmentTypeRepository;
    private $listGarmentTypesTransform;
    
    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        ListGarmentTypesTransformInterface $listGarmentTypesTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->listGarmentTypesTransform = $listGarmentTypesTransform;
    }
    
    public function handle(): array
    {
        $queryOutput = $this->garmentTypeRepository->listGarmentTypes();
        
        return $this->listGarmentTypesTransform->transform($queryOutput);
    }
}

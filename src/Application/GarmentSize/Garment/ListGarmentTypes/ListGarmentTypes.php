<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryI;

class ListGarmentTypes
{
    private $garmentTypeRepository;
    private $listGarmentTypesTransform;
    
    public function __construct(
        GarmentTypeRepositoryI $garmentTypeRepository,
        ListGarmentTypesTransformI $listGarmentTypesTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->listGarmentTypesTransform = $listGarmentTypesTransform;
    }
    
    public function handle(ListGarmentTypesCommand $listGarmentTypesCommand): array
    {
        $queryOutput = $this->garmentTypeRepository->listGarmentTypes();
        
        return $this->listGarmentTypesTransform->transform($queryOutput);
    }
}

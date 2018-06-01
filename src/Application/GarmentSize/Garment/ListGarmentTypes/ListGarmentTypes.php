<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;

class ListGarmentTypes
{
    private $garmentTypeRepository;
    private $listGarmentTypesTransform;
    
    public function __construct(
        GarmentTypeRepository $garmentTypeRepository,
        ListGarmentTypesTransformI $listGarmentTypesTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->listGarmentTypesTransform = $listGarmentTypesTransform;
    }
    
    public function handle(ListGarmentTypesCommand $listGarmentTypesCommand): array
    {
        return $this->listGarmentTypesTransform->transform(
            $this->garmentTypeRepository->listGarmentTypes()
        );
    }
}

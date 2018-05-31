<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryI;

class ListGarment
{
    private $garmentRepository;
    private $listGarmentTransform;

    public function __construct(
        GarmentRepositoryI $garmentRepository,
        ListGarmentTransformI $listGarmentTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->listGarmentTransform = $listGarmentTransform;
    }

    public function handle(ListGarmentCommand $listGarmentCommand): array
    {
        $garments = $this->garmentRepository->listGarment();
        
        return $this->listGarmentTransform->transform($garments);
    }
}

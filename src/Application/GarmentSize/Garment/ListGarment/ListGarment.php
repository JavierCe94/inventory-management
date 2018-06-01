<?php

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepository;

class ListGarment
{
    private $garmentRepository;
    private $listGarmentTransform;

    public function __construct(
        GarmentRepository $garmentRepository,
        ListGarmentTransformI $listGarmentTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->listGarmentTransform = $listGarmentTransform;
    }

    public function handle(ListGarmentCommand $listGarmentCommand): array
    {
        return $this->listGarmentTransform->transform(
            $this->garmentRepository->listGarment()
        );
    }
}

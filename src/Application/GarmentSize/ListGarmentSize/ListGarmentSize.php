<?php

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository;

class ListGarmentSize
{
    private $garmentSizeRepository;
    private $listGarmentSizeTransform;

    public function __construct(
        GarmentSizeRepository $garmentSizeRepository,
        ListGarmentSizeTransformI $listGarmentSizeTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->listGarmentSizeTransform = $listGarmentSizeTransform;
    }

    public function handle(ListGarmentSizeCommand $listGarmentSizeCommand): array
    {
        return $this->listGarmentSizeTransform->transform(
            $this->garmentSizeRepository->findAllGarmentSize()
        );
    }
}

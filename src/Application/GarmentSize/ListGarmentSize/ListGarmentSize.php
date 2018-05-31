<?php

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryI;

class ListGarmentSize
{
    private $garmentSizeRepository;
    private $listGarmentSizeTransform;

    public function __construct(
        GarmentSizeRepositoryI $garmentSizeRepository,
        ListGarmentSizeTransformI $listGarmentSizeTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->listGarmentSizeTransform = $listGarmentSizeTransform;
    }

    public function handle(ListGarmentSizeCommand $listGarmentSizeCommand): array
    {
        $list = $this->garmentSizeRepository->findAllGarmentSize();
        $list = $this->listGarmentSizeTransform->transform($list);

        return $list;
    }
}

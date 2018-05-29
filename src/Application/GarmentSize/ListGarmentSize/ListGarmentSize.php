<?php

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;

class ListGarmentSize
{
    private $garmentSizeRepository;
    private $listGarmentSizeTransform;

    /**
     * ListGarmentSize constructor.
     * @param GarmentSizeRepositoryInterface $garmentSizeRepository
     * @param ListGarmentSizeTransformInterface $listGarmentSizeTransform
     */
    public function __construct(
        GarmentSizeRepositoryInterface $garmentSizeRepository,
        ListGarmentSizeTransformInterface $listGarmentSizeTransform
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

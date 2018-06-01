<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListAllSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;

class ListAllSize
{
    private $sizeRepository;
    private $listAllSizeTransform;
    
    public function __construct(
        SizeRepository $sizeRepository,
        ListAllSizeTransformI $listAllSizeTransform
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->listAllSizeTransform = $listAllSizeTransform;
    }

    public function handle(ListAllSizeCommand $listAllSizeCommand): array
    {
        return $this->listAllSizeTransform->transform(
            $this->sizeRepository->findAllSize()
        );
    }
}

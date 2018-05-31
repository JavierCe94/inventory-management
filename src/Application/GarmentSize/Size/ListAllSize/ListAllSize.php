<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListAllSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryI;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class ListAllSize
{
    private $sizeRepository;
    private $listAllSizeTransform;
    
    public function __construct(
        SizeRepositoryI $sizeRepository,
        ListAllSizeTransformI $listAllSizeTransform
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->listAllSizeTransform = $listAllSizeTransform;
    }

    public function handle(ListAllSizeCommand $listAllSizeCommand): array
    {
        $allSize = $this->sizeRepository->findAllSize();
        $allSize = $this->listAllSizeTransform->transform($allSize);

        return $allSize;
    }
}

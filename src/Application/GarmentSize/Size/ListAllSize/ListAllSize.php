<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListAllSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class ListAllSize
{
    private $sizeRepository;
    private $listAllSizeTransform;
    
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        ListAllSizeTransformInterface $listAllSizeTransform
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->listAllSizeTransform = $listAllSizeTransform;
    }

    public function handle(ListAllSizeCommand $listAllSizeCommand): array
    {
        $allSize = $this->sizeRepository->findAllSize();
        $allSize = $this->listAllSizeTransform->transform($allSize);

        return [
            "data" => $allSize,
            "code" => HttpResponses::OK
        ];
    }
}

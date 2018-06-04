<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;

class ListSizeByGarmentType
{
    private $dataTransform;
    private $sizeRepository;
    private $findGarmentTypeIfExists;
    
    public function __construct(
        SizeRepository $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExists,
        ListSizeByGarmentTypeTransformI $dataTransform
    ) {
        $this->dataTransform = $dataTransform;
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
    }
    
    public function handle(ListSizeByGarmentTypeCommand $listSizeByGarmentTypeCommand): array
    {
        $this->findGarmentTypeIfExists->execute(
            $listSizeByGarmentTypeCommand->getGarmentTypeId()
        );
        
        return $this->dataTransform->transform(
            $this->sizeRepository->findByGarmentType(
                $listSizeByGarmentTypeCommand->getGarmentTypeId()
            )
        );
    }
}

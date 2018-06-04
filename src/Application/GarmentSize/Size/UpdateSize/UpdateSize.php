<?php

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\FindSizeIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;

class UpdateSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExist;
    private $dataTransform;
    private $findSizeIfExist;
    
    public function __construct(
        SizeRepository $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExist,
        UpdateSizeTransformI $dataTransform,
        FindSizeIfExists $findSizeIfExist
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExist = $findGarmentTypeIfExist;
        $this->dataTransform = $dataTransform;
        $this->findSizeIfExist = $findSizeIfExist;
    }
    
    public function handle(UpdateSizeCommand $updateSizeCommand): string
    {
        $this->findGarmentTypeIfExist->execute(
            $updateSizeCommand->getGarmentTypeId()
        );
        $this->sizeRepository->updateSize(
            $this->findSizeIfExist->execute(
                $updateSizeCommand->getGarmentTypeId(),
                $updateSizeCommand->getSizeValue()
            ),
            $updateSizeCommand->getNewSizeValue()
        );

        return $this->dataTransform->transform();
    }
}

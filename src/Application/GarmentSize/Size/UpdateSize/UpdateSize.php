<?php

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\FindSizeEntityIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;

class UpdateSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExist;
    private $dataTransform;
    private $findSizeEntityIfExist;
    
    public function __construct(
        SizeRepository $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExist,
        UpdateSizeTransformI $dataTransform,
        FindSizeEntityIfExists $findSizeEntityIfExist
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExist = $findGarmentTypeIfExist;
        $this->dataTransform = $dataTransform;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
    }
    
    public function handle(UpdateSizeCommand $updateSizeCommand)
    {
        $this->findGarmentTypeIfExist->execute(
            $updateSizeCommand->getGarmentTypeId()
        );
        $this->sizeRepository->updateSize(
            $this->findSizeEntityIfExist->execute(
                $updateSizeCommand->getGarmentTypeId(),
                $updateSizeCommand->getSizeValue()
            ),
            $updateSizeCommand->getNewSizeValue()
        );

        return $this->dataTransform->transform();
    }
}

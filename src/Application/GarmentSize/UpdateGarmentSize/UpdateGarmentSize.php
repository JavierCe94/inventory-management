<?php

namespace Inventory\Management\Application\GarmentSize\UpdateGarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\FindGarmentSizeIfExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\CheckGarmentTypeAreEquals;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\FindSizeIfExists;

class UpdateGarmentSize
{
    private $garmentSizeRepository;
    private $findGarmentIfExist;
    private $findSizeEntityIfExist;
    private $findGarmentSizeIfExist;
    private $checkGarmentTypeAreEquals;
    private $dataTransform;
    
    public function __construct(
        GarmentSizeRepository $garmentSizeRepository,
        FindGarmentIfExists $findGarmentIfExist,
        FindSizeIfExists $findSizeEntityIfExist,
        FindGarmentSizeIfExist $findGarmentSizeIfExist,
        CheckGarmentTypeAreEquals $checkGarmentTypeAreEquals,
        UpdateGarmentSizeTransformI $dataTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->findGarmentIfExist = $findGarmentIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->findGarmentSizeIfExist = $findGarmentSizeIfExist;
        $this->checkGarmentTypeAreEquals = $checkGarmentTypeAreEquals;
        $this->dataTransform = $dataTransform;
    }
    
    public function handle(UpdateGarmentSizeCommand $updateGarmentSizeCommand): string
    {
        $size = $this->findSizeEntityIfExist->execute(
            $updateGarmentSizeCommand->getIdSize(),
            $updateGarmentSizeCommand->getSizeValue()
        );
        $garment = $this->findGarmentIfExist->execute(
            $updateGarmentSizeCommand->getIdGarment()
        );
        $this->checkGarmentTypeAreEquals->execute(
            $size->getGarmentType(),
            $garment->getGarmentType()
        );
        $this->garmentSizeRepository->updateStockGarmentSize(
            $this->findGarmentSizeIfExist->execute(
                $size,
                $garment
            ),
            $updateGarmentSizeCommand->getStock()
        );

        return $this->dataTransform->transform();
    }
}

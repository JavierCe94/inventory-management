<?php

namespace Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable;

use Inventory\Management\Domain\Model\Entity\GarmentSize\CheckGarmentSizeExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\CheckGarmentTypeAreEquals;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\FindSizeIfExists;

class CreateGarmentSizeTable
{
    private $garmentSizeRepository;
    private $findGarmentIfExist;
    private $findSizeEntityIfExist;
    private $checkGarmentSizeExist;
    private $checkGarmentTypeAreEquals;
    private $dataTransform;

    public function __construct(
        GarmentSizeRepository $garmentSizeRepository,
        FindGarmentIfExists $findGarmentIfExist,
        FindSizeIfExists $findSizeEntityIfExist,
        CheckGarmentSizeExist $checkGarmentSizeExist,
        CheckGarmentTypeAreEquals $checkGarmentTypeAreEquals,
        CreateGarmentSizeTableTransformI $dataTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->findGarmentIfExist = $findGarmentIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->checkGarmentSizeExist = $checkGarmentSizeExist;
        $this->checkGarmentTypeAreEquals = $checkGarmentTypeAreEquals;
        $this->dataTransform = $dataTransform;
    }

    public function handle(CreateGarmentSizeTableCommand $createGarmentSizeTableCommand): string
    {
        $size = $this->findSizeEntityIfExist->execute(
            $createGarmentSizeTableCommand->getIdSize(),
            $createGarmentSizeTableCommand->getSizeValue()
        );
        $garment = $this->findGarmentIfExist->execute(
            $createGarmentSizeTableCommand->getIdGarment()
        );
        $this->checkGarmentTypeAreEquals->execute(
            $size->getGarmentType(),
            $garment->getGarmentType()
        );
        $this->checkGarmentSizeExist->execute(
            $size,
            $garment
        );
        $this->garmentSizeRepository->createGarmentSize(
            GarmentSize::createFromApi(
                $size,
                $garment
            )
        );

        return $this->dataTransform->transform();
    }
}

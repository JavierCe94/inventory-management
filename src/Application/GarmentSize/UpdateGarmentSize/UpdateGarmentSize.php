<?php

namespace Inventory\Management\Application\GarmentSize\UpdateGarmentSize;

use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTableTransformI;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryI;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\FindGarmentSizeIfExistI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\CheckGarmentTypeAreEqualsI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExistsI;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExistsI;

class UpdateGarmentSize
{
    private $garmentSizeRepository;
    private $findGarmentIfExist;
    private $findSizeEntityIfExist;
    private $findGarmentSizeIfExist;
    private $checkGarmentTypeAreEquals;
    private $dataTransform;
    
    public function __construct(
        GarmentSizeRepositoryI $garmentSizeRepository,
        FindGarmentIfExistsI $findGarmentIfExist,
        FindSizeEntityIfExistsI $findSizeEntityIfExist,
        FindGarmentSizeIfExistI $findGarmentSizeIfExist,
        CheckGarmentTypeAreEqualsI $checkGarmentTypeAreEquals,
        CreateGarmentSizeTableTransformI $dataTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->findGarmentIfExist = $findGarmentIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->findGarmentSizeIfExist = $findGarmentSizeIfExist;
        $this->checkGarmentTypeAreEquals = $checkGarmentTypeAreEquals;
        $this->dataTransform = $dataTransform;
    }

    /**
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeNotExist
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypesAreNotEquals
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist
     */
    public function handle(UpdateGarmentSizeCommand $updateGarmentSizeCommand)
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
        $garmentSize = $this->findGarmentSizeIfExist->__invoke(
            $size,
            $garment
        );
        $garmentSize->setStock($updateGarmentSizeCommand->getStock());
        $this->garmentSizeRepository->persistAndFlush($garmentSize);

        return $this->dataTransform->transform();
    }
}

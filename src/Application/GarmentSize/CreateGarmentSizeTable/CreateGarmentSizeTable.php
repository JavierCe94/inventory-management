<?php

namespace Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryI;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\CheckGarmentSizeExistI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\CheckGarmentTypeAreEqualsI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExistsI;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExistsI;


class CreateGarmentSizeTable
{
    private $garmentSizeRepository;
    private $findGarmentIfExist;
    private $findSizeEntityIfExist;
    private $checkGarmentSizeExist;
    private $checkGarmentTypeAreEquals;
    private $dataTransform;

    public function __construct(
        GarmentSizeRepositoryI $garmentSizeRepository,
        FindGarmentIfExistsI $findGarmentIfExist,
        FindSizeEntityIfExistsI $findSizeEntityIfExist,
        CheckGarmentSizeExistI $checkGarmentSizeExist,
        CheckGarmentTypeAreEqualsI $checkGarmentTypeAreEquals,
        CreateGarmentSizeTableTransformI $dataTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->findGarmentIfExist = $findGarmentIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->checkGarmentSizeExist = $checkGarmentSizeExist;
        $this->checkGarmentTypeAreEquals = $checkGarmentTypeAreEquals;
        $this->dataTransform = $dataTransform;
    }

    /**
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeAlreadyExist
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypesAreNotEquals
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist
     */
    public function handle(CreateGarmentSizeTableCommand $createGarmentSizeTableCommand)
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
        $this->checkGarmentSizeExist->__invoke(
            $size,
            $garment
        );
        $newGarmentSize = GarmentSize::createFromApi(
            $size,
            $garment
        );
        $this->garmentSizeRepository->persistAndFlush($newGarmentSize);

        return $this->dataTransform->transform();
    }
}

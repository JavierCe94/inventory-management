<?php

namespace Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\CheckGarmentSizeExist;
use Inventory\Management\Domain\Service\GarmentSize\Garment\CheckGarmentTypeAreEquals;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;

class CreateGarmentSizeTable
{
    private $garmentSizeRepository;
    private $findGarmentIfExist;
    private $findSizeEntityIfExist;
    private $checkGarmentSizeExist;
    private $checkGarmentTypeAreEquals;
    private $dataTransform;

    /**
     * CreateGarmentSizeTable constructor.
     * @param GarmentSizeRepositoryInterface $garmentSizeRepository
     * @param FindGarmentIfExists $findGarmentIfExist
     * @param FindSizeEntityIfExists $findSizeEntityIfExist
     * @param CheckGarmentSizeExist $checkGarmentSizeExist
     * @param CheckGarmentTypeAreEquals $checkGarmentTypeAreEquals
     * @param CreateGarmentSizeTableTransformInterface $dataTransform
     */
    public function __construct(
        GarmentSizeRepositoryInterface $garmentSizeRepository,
        FindGarmentIfExists $findGarmentIfExist,
        FindSizeEntityIfExists $findSizeEntityIfExist,
        CheckGarmentSizeExist $checkGarmentSizeExist,
        CheckGarmentTypeAreEquals $checkGarmentTypeAreEquals,
        CreateGarmentSizeTableTransformInterface $dataTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->findGarmentIfExist = $findGarmentIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->checkGarmentSizeExist = $checkGarmentSizeExist;
        $this->checkGarmentTypeAreEquals = $checkGarmentTypeAreEquals;
        $this->dataTransform = $dataTransform;
    }

    /**
     * @param CreateGarmentSizeTableCommand $createGarmentSizeTableCommand
     * @return array
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

        return [
            "data" => "created",
            "code" => HttpResponses::OK
        ];
    }
}

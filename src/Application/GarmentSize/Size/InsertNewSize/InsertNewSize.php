<?php

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\CheckIfSizeEntityExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;

class InsertNewSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExists;
    private $checkIfSizeEntityExist;
    private $insertNewSizeTransform;
    
    public function __construct(
        SizeRepository $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExists,
        CheckIfSizeEntityExist $checkIfSizeEntityExist,
        InsertNewSizeTransformI $insertNewSizeTransform
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
        $this->insertNewSizeTransform = $insertNewSizeTransform;
        $this->checkIfSizeEntityExist = $checkIfSizeEntityExist;
    }
    
    public function handle(InsertNewSizeCommand $insertNewSizeCommand)
    {
        $this->checkIfSizeEntityExist->execute(
            $insertNewSizeCommand->getGarmentTypeId(),
            $insertNewSizeCommand->getSizeValue()
        );
        $this->sizeRepository->addSize(
            new Size(
                $this->findGarmentTypeIfExists->execute(
                    $insertNewSizeCommand->getGarmentTypeId()
                ),
                $insertNewSizeCommand->getSizeValue()
            )
        );

        return $this->insertNewSizeTransform->transform();
    }
}

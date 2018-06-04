<?php

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\CheckIfSizeExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;

class InsertNewSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExists;
    private $checkIfSizeExist;
    private $insertNewSizeTransform;
    
    public function __construct(
        SizeRepository $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExists,
        CheckIfSizeExist $checkIfSizeExist,
        InsertNewSizeTransformI $insertNewSizeTransform
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
        $this->insertNewSizeTransform = $insertNewSizeTransform;
        $this->checkIfSizeExist = $checkIfSizeExist;
    }
    
    public function handle(InsertNewSizeCommand $insertNewSizeCommand): string
    {
        $this->checkIfSizeExist->execute(
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

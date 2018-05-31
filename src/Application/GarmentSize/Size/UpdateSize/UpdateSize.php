<?php

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryI;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExistsI;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExistsI;

class UpdateSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExist;
    private $dataTransform;
    private $findSizeEntityIfExist;
    
    public function __construct(
        SizeRepositoryI $sizeRepository,
        FindGarmentTypeIfExistsI $findGarmentTypeIfExist,
        UpdateSizeTransformI $dataTransform,
        FindSizeEntityIfExistsI $findSizeEntityIfExist
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExist = $findGarmentTypeIfExist;
        $this->dataTransform = $dataTransform;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
    }

    /**
     * @throws SizeDoNotExist
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException
     */
    public function handle(UpdateSizeCommand $updateSizeCommand)
    {
        $this->findGarmentTypeIfExist->execute(
            $updateSizeCommand->getGarmentTypeId()
        );
        $size = $this->findSizeEntityIfExist->execute(
            $updateSizeCommand->getGarmentTypeId(),
            $updateSizeCommand->getSizeValue()
        );
        $sizeUpdated  = $this->sizeRepository->updateSize(
            $updateSizeCommand->getNewSizeValue(),
            $size
        );
        $this->sizeRepository->persistAndFlush($sizeUpdated);

        return $this->dataTransform->transform($sizeUpdated);
    }
}

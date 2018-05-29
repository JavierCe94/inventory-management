<?php

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;

class UpdateSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExist;
    private $dataTransform;
    private $findSizeEntityIfExist;
    
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExist,
        UpdateSizeTransformInterface $dataTransform,
        FindSizeEntityIfExists $findSizeEntityIfExist
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExist = $findGarmentTypeIfExist;
        $this->dataTransform = $dataTransform;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
    }

    /**
     * @param UpdateSizeCommand $updateSizeCommand
     * @return array
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

        return [
            "data" => $this->dataTransform->transform($sizeUpdated),
            "code" => HttpResponses::OK
        ];
    }
}

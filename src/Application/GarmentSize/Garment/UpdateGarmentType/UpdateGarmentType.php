<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExistsI;

class UpdateGarmentType
{
    private $garmentTypeRepository;
    private $updateGarmentTypeTransform;
    private $findGarmentTypeIfExists;
    
    public function __construct(
        GarmentTypeRepositoryI $garmentTypeRepository,
        UpdateGarmentTypeTransformI $updateGarmentTypeTransform,
        FindGarmentTypeIfExistsI $findGarmentIfExists
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->updateGarmentTypeTransform = $updateGarmentTypeTransform;
        $this->findGarmentTypeIfExists = $findGarmentIfExists;
    }

    /**
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException
     */
    public function handle(UpdateGarmentTypeCommand $updateGarmentTypeCommand): array
    {
        $garmentTypeEntity = $this->findGarmentTypeIfExists->execute(
            $updateGarmentTypeCommand->getId()
        );
        $this->garmentTypeRepository->updateGarmentType(
            $garmentTypeEntity,
            $updateGarmentTypeCommand->getName()
        );

        return $this->updateGarmentTypeTransform->transform();
    }
}

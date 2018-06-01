<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;

class UpdateGarmentType
{
    private $garmentTypeRepository;
    private $updateGarmentTypeTransform;
    private $findGarmentTypeIfExists;
    
    public function __construct(
        GarmentTypeRepository $garmentTypeRepository,
        UpdateGarmentTypeTransformI $updateGarmentTypeTransform,
        FindGarmentTypeIfExists $findGarmentIfExists
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->updateGarmentTypeTransform = $updateGarmentTypeTransform;
        $this->findGarmentTypeIfExists = $findGarmentIfExists;
    }

    public function handle(UpdateGarmentTypeCommand $updateGarmentTypeCommand): string
    {
        $this->garmentTypeRepository->updateGarmentType(
            $this->findGarmentTypeIfExists->execute(
                $updateGarmentTypeCommand->getId()
            ),
            $updateGarmentTypeCommand->getName()
        );

        return $this->updateGarmentTypeTransform->transform();
    }
}

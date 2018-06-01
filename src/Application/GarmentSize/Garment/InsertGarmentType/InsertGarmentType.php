<?php

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;

class InsertGarmentType
{
    private $garmentTypeRepository;
    private $garmentTypeNameExists;
    private $dataTransform;
    
    public function __construct(
        GarmentTypeRepository $garmentTypeRepository,
        GarmentTypeNameExists $garmentTypeNameExists,
        InsertGarmentTypeTransformI $dataTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->garmentTypeNameExists = $garmentTypeNameExists;
        $this->dataTransform = $dataTransform;
    }

    public function handle(InsertGarmentTypeCommand $insertGarmentTypeCommand): string
    {
        $this->garmentTypeNameExists->execute(
            $insertGarmentTypeCommand->getName()
        );
        $this->garmentTypeRepository->insertGarmentType(
            new GarmentType(
                $insertGarmentTypeCommand->getName()
            )
        );

        return $this->dataTransform->transform();
    }
}

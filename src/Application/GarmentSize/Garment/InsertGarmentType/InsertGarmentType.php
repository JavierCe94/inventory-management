<?php

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\GarmentTypeNameExistsI;

class InsertGarmentType
{
    private $garmentTypeRepository;
    private $insertGarmentTypeTransform;
    private $garmentTypeNameExists;
    private $dataTransform;
    
    public function __construct(
        GarmentTypeRepositoryI $garmentTypeRepository,
        InsertGarmentTypeTransformI $insertGarmentTypeTransform,
        GarmentTypeNameExistsI $garmentTypeNameExists,
        InsertGarmentTypeTransformI $dataTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTypeTransform = $insertGarmentTypeTransform;
        $this->garmentTypeNameExists = $garmentTypeNameExists;
        $this->dataTransform = $dataTransform;
    }

    /**
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException
     */
    public function handle(InsertGarmentTypeCommand $insertGarmentTypeCommand): array
    {
        $this->garmentTypeNameExists->check(
            $insertGarmentTypeCommand->getName()
        );
        $garmentTypeEntity = $this->garmentTypeRepository->insertGarmentType(
            $insertGarmentTypeCommand->getName()
        );
        $this->garmentTypeRepository->persistAndFlush($garmentTypeEntity);

        return $this->dataTransform->transform();
    }
}

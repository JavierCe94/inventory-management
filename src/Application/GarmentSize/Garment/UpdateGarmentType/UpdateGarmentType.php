<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;

class UpdateGarmentType
{
    const OK = 'GarmentType actualizado con exito';
    const CODE_OK = 200;

    private $garmentTypeRepository;
    private $updateGarmentTypeTransform;
    private $findGarmentTypeIfExists;
    
    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        UpdateGarmentTypeTransformInterface $updateGarmentTypeTransform,
        FindGarmentTypeIfExists $findGarmentIfExists
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->updateGarmentTypeTransform = $updateGarmentTypeTransform;
        $this->findGarmentTypeIfExists = $findGarmentIfExists;
    }

    /**
     * @param UpdateGarmentTypeCommand $updateGarmentTypeCommand
     * @return array
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

        return [
            'data' => self::OK,
            'code' => self::CODE_OK
        ];
    }
}

<?php

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\GarmentTypeNameExists;

class InsertGarmentType
{
    const OK = 'Tipo prenda insertado con exito';
    const CODE_OK = 200;

    private $garmentTypeRepository;
    private $insertGarmentTypeTransform;
    private $garmentTypeNameExists;
    
    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        InsertGarmentTypeTransformInterface $insertGarmentTypeTransform,
        GarmentTypeNameExists $garmentTypeNameExists
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTypeTransform = $insertGarmentTypeTransform;
        $this->garmentTypeNameExists = $garmentTypeNameExists;
    }

    /**
     * @param InsertGarmentTypeCommand $insertGarmentTypeCommand
     * @return array
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

        return [
            'data' => self::OK,
            'code' => self::CODE_OK
        ];
    }
}

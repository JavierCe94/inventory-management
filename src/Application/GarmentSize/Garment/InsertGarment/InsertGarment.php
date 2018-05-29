<?php

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Garment\GarmentNameExists;

class InsertGarment
{
    const OK = 'Garment insertado con exito';
    const CODE_OK = 200;

    private $garmentRepository;
    private $garmentTypeRepository;
    private $insertGarmentTransform;
    private $garmentNameExists;
    private $findGarmentTypeIfExists;
    
    public function __construct(
        GarmentRepositoryInterface $garmentRepository,
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        InsertGarmentTransformInterface $insertGarmentTransform,
        GarmentNameExists $garmentNameExists,
        FindGarmentTypeIfExists $findGarmentTypeIfExists
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTransform = $insertGarmentTransform;
        $this->garmentNameExists = $garmentNameExists;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
    }

    /**
     * @param InsertGarmentCommand $insertGarmentCommand
     * @return array
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExistsException
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException
     */
    public function handle(InsertGarmentCommand $insertGarmentCommand): array
    {
        $garmentTypeEntity = $this->findGarmentTypeIfExists->execute(
            $insertGarmentCommand->getGarmentTypeId()
        );
        $this->garmentNameExists->check(
            $insertGarmentCommand->getName()
        );
        $garmentEntity = $this->garmentRepository->insertGarment(
            $insertGarmentCommand->getName(),
            $garmentTypeEntity
        );
        $this->garmentRepository->persistAndFlush($garmentEntity);

        return [
            'data' => self::OK,
            'code' => self::CODE_OK
        ];
    }
}

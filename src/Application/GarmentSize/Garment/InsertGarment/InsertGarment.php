<?php

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryI;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExistsI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\GarmentNameExistsI;

class InsertGarment
{
    private $garmentRepository;
    private $garmentTypeRepository;
    private $insertGarmentTransform;
    private $garmentNameExists;
    private $findGarmentTypeIfExists;
    
    public function __construct(
        GarmentRepositoryI $garmentRepository,
        GarmentTypeRepositoryI $garmentTypeRepository,
        InsertGarmentTransformI $insertGarmentTransform,
        GarmentNameExistsI $garmentNameExists,
        FindGarmentTypeIfExistsI $findGarmentTypeIfExists
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTransform = $insertGarmentTransform;
        $this->garmentNameExists = $garmentNameExists;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
    }

    /**
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

        return $this->insertGarmentTransform->transform();
    }
}

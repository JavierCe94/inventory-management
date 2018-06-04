<?php

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;

class InsertGarment
{
    private $garmentRepository;
    private $garmentTypeRepository;
    private $insertGarmentTransform;
    private $garmentNameExists;
    private $findGarmentTypeIfExists;
    
    public function __construct(
        GarmentRepository $garmentRepository,
        GarmentTypeRepository $garmentTypeRepository,
        InsertGarmentTransformI $insertGarmentTransform,
        GarmentNameExists $garmentNameExists,
        FindGarmentTypeIfExists $findGarmentTypeIfExists
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTransform = $insertGarmentTransform;
        $this->garmentNameExists = $garmentNameExists;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
    }

    public function handle(InsertGarmentCommand $insertGarmentCommand): string
    {
        $this->garmentNameExists->execute(
            $insertGarmentCommand->getName()
        );
        $this->garmentRepository->insertGarment(
            new Garment(
                $this->findGarmentTypeIfExists->execute(
                    $insertGarmentCommand->getGarmentTypeId()
                ),
                $insertGarmentCommand->getName()
            )
        );

        return $this->insertGarmentTransform->transform();
    }
}

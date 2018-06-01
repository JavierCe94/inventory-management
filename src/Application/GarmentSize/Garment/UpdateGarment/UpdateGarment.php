<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepository;

class UpdateGarment
{
    private $garmentRepository;
    private $findGarmentIfExists;
    private $dataTransform;

    public function __construct(
        GarmentRepository $garmentRepository,
        FindGarmentIfExists $findGarmentIfExists,
        UpdateGarmentTransformI $dataTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->findGarmentIfExists = $findGarmentIfExists;
        $this->dataTransform = $dataTransform;
    }

    public function handle(UpdateGarmentCommand $updateGarmentCommand): string
    {
        $this->garmentRepository->updateGarment(
            $this->findGarmentIfExists->execute(
                $updateGarmentCommand->getId()
            ),
            $updateGarmentCommand->getName()
        );

        return $this->dataTransform->transform();
    }
}

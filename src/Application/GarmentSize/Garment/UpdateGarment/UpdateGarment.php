<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryI;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExistsI;

class UpdateGarment
{
    private $garmentRepository;
    private $updateGarmentTransform;
    private $findGarmentIfExists;
    private $dataTransform;

    public function __construct(
        GarmentRepositoryI $garmentRepository,
        UpdateGarmentTransformI $updateGarmentTransform,
        FindGarmentIfExistsI $findGarmentIfExists,
        UpdateGarmentTransformI $dataTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->updateGarmentTransform = $updateGarmentTransform;
        $this->findGarmentIfExists = $findGarmentIfExists;
        $this->dataTransform = $dataTransform;
    }

    /**
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException
     */
    public function handle(UpdateGarmentCommand $updateGarmentCommand): array
    {
        $garmentEntity = $this->findGarmentIfExists->execute(
            $updateGarmentCommand->getId()
        );
        $this->garmentRepository->updateGarment(
            $garmentEntity,
            $updateGarmentCommand->getName()
        );

        return $this->dataTransform->transform();
    }
}

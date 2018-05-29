<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;

class UpdateGarment
{
    const OK = 'Garment actualizado con exito';
    const CODE_OK = 200;

    private $garmentRepository;
    private $updateGarmentTransform;
    private $findGarmentIfExists;

    public function __construct(
        GarmentRepositoryInterface $garmentRepository,
        UpdateGarmentTransformInterface $updateGarmentTransform,
        FindGarmentIfExists $findGarmentIfExists
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->updateGarmentTransform = $updateGarmentTransform;
        $this->findGarmentIfExists = $findGarmentIfExists;
    }

    /**
     * @param UpdateGarmentCommand $updateGarmentCommand
     * @return array
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

        return [
            'data' => self::OK,
            'code' => self::CODE_OK
        ];
    }
}

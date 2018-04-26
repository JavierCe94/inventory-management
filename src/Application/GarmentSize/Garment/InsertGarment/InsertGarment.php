<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 10:06
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;

class InsertGarment
{
    private $garmentRepository;
    private $garmentTypeRepository;
    private $insertGarmentTransform;

    public function __construct(
        GarmentRepository $garmentRepository,
        GarmentTypeRepository $garmentTypeRepository,
        InsertGarmentTransformInterface $insertGarmentTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTransform = $insertGarmentTransform;
    }

    public function handle(InsertGarmentCommand $insertGarmentCommand)
    {
        $garmentEntity = $this->garmentRepository->insertGarment(
            $insertGarmentCommand->getName(),
            $this->garmentTypeRepository->findGarmentTypeById(
                $insertGarmentCommand->getGarmentTypeId()
            )
        );

        $this->garmentRepository->persistAndFlush($garmentEntity);
    }
}
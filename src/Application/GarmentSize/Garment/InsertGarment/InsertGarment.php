<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 10:06
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;

class InsertGarment
{
    private $garmentRepository;
    private $insertGarmentTransform;

    public function __construct(
        GarmentRepository $garmentRepository,
        InsertGarmentTransformInterface $insertGarmentTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->insertGarmentTransform = $insertGarmentTransform;
    }

    public function handle(InsertGarmentCommand $insertGarmentCommand)
    {
        $garmentEntity = $this->garmentRepository->insertGarment(
            $insertGarmentCommand->getName(),
            $insertGarmentCommand->getGarmentTypeId()
        );

        $this->garmentRepository->persistAndFlush($garmentEntity);
    }
}
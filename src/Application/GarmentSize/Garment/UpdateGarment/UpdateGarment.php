<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 26/04/18
 * Time: 13:15
 */

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;

class UpdateGarment
{
    private $garmentRepository;
    private $updateGarmentTransform;

    /**
     * UpdateGarment constructor.
     *
     * @param GarmentRepository      $garmentRepository
     * @param UpdateGarmentTransform $updateGarmentTransform
     */
    public function __construct(
        GarmentRepository $garmentRepository,
        UpdateGarmentTransform $updateGarmentTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->updateGarmentTransform = $updateGarmentTransform;
    }

    public function handle(UpdateGarmentCommand $updateGarmentCommand)
    {
        $garmentEntity = $this->garmentRepository->findGarmentById($updateGarmentCommand->getId());

        if (is_null($garmentEntity)) {
            throw new GarmentNotExistsException();
        }

        $this
            ->garmentRepository
            ->updateGarment(
                $garmentEntity,
                $updateGarmentCommand->getName()
            );
    }
}

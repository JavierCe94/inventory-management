<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 26/04/18
 * Time: 12:25
 */

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class UpdateGarmentType
{
    private $garmentTypeRepository;
    private $updateGarmentTypeTransform;

    /**
     * UpdateGarmentType constructor.
     *
     * @param GarmentTypeRepositoryInterface      $garmentTypeRepository
     * @param UpdateGarmentTypeTransformInterface $updateGarmentTypeTransform
     */
    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        UpdateGarmentTypeTransformInterface $updateGarmentTypeTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->updateGarmentTypeTransform = $updateGarmentTypeTransform;
    }

    /**
     * @param UpdateGarmentTypeCommand $updateGarmentTypeCommand
     *
     * @throws GarmentTypeNotExistsException
     */
    public function handle(UpdateGarmentTypeCommand $updateGarmentTypeCommand): void
    {

        $garmentTypeId = $updateGarmentTypeCommand->getId();

        $garmentTypeEntity = $this->garmentTypeRepository->findGarmentTypeById($garmentTypeId);

        if (is_null($garmentTypeEntity)) {
            throw new GarmentTypeNotExistsException();
        }

        $this
            ->garmentTypeRepository
            ->updateGarmentType(
                $garmentTypeEntity,
                $updateGarmentTypeCommand->getName()
            );
    }
}

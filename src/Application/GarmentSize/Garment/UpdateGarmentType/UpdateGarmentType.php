<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 26/04/18
 * Time: 12:25
 */

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;

class UpdateGarmentType
{
    const OK = 'GarmentType actualizado con exito';
    const CODE_OK = 200;

    private $garmentTypeRepository;
    private $updateGarmentTypeTransform;
    private $findGarmentTypeIfExists;

    /**
     * UpdateGarmentType constructor.
     *
     * @param GarmentTypeRepositoryInterface      $garmentTypeRepository
     * @param UpdateGarmentTypeTransformInterface $updateGarmentTypeTransform
     * @param FindGarmentTypeIfExists             $findGarmentIfExists
     */
    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        UpdateGarmentTypeTransformInterface $updateGarmentTypeTransform,
        FindGarmentTypeIfExists $findGarmentIfExists
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->updateGarmentTypeTransform = $updateGarmentTypeTransform;
        $this->findGarmentTypeIfExists = $findGarmentIfExists;
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($this->findGarmentTypeIfExists);
    }

    /**
     * @param UpdateGarmentTypeCommand $updateGarmentTypeCommand
     *
     * @return array
     */
    public function handle(UpdateGarmentTypeCommand $updateGarmentTypeCommand): array
    {
        $output = ['data' => self::OK, 'code' => self::CODE_OK ];

        $garmentTypeId = $updateGarmentTypeCommand->getId();
        $garmentTypeName = $updateGarmentTypeCommand->getName();

        $garmentTypeEntity = $this->findGarmentTypeIfExists->execute($garmentTypeId);

        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }

        $this
            ->garmentTypeRepository
            ->updateGarmentType(
                $garmentTypeEntity,
                $garmentTypeName
            );

        return $output;
    }
}

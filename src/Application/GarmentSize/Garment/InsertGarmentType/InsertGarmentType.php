<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 10:16
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;

class InsertGarmentType
{
    private $garmentTypeRepository;
    private $insertGarmentTypeTransform;

    /**
     * InsertGarmentType constructor.
     *
     * @param GarmentTypeRepository      $garmentTypeRepository
     * @param InsertGarmentTypeTransform $insertGarmentTypeTransform
     */
    public function __construct(
        GarmentTypeRepository $garmentTypeRepository,
        InsertGarmentTypeTransform $insertGarmentTypeTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTypeTransform = $insertGarmentTypeTransform;
    }

    /**
     * @param InsertGarmentTypeCommand $insertGarmentTypeCommand
     */
    public function handle(InsertGarmentTypeCommand $insertGarmentTypeCommand): void
    {
        $garmentTypeEntity = $this->garmentTypeRepository->insertGarmentType($insertGarmentTypeCommand->getName());
        $this->garmentTypeRepository->persistAndFlush($garmentTypeEntity);
    }
}
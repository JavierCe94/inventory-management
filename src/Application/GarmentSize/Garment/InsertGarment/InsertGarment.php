<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 10:06
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;

class InsertGarment
{
    private $garmentRepository;
    private $garmentTypeRepository;
    private $insertGarmentTransform;

    /**
     * InsertGarment constructor.
     *
     * @param GarmentRepository      $garmentRepository
     * @param GarmentTypeRepository  $garmentTypeRepository
     * @param InsertGarmentTransform $insertGarmentTransform
     */
    public function __construct(
        GarmentRepository $garmentRepository,
        GarmentTypeRepository $garmentTypeRepository,
        InsertGarmentTransform $insertGarmentTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTransform = $insertGarmentTransform;
    }

    /**
     * @param InsertGarmentCommand $insertGarmentCommand
     *
     * @throws GarmentTypeNotExistsException
     */
    public function handle(InsertGarmentCommand $insertGarmentCommand)
    {
        $garmentTypeEntity = $this
            ->garmentTypeRepository
            ->findGarmentTypeById($insertGarmentCommand->getGarmentTypeId());

        if (is_null($garmentTypeEntity)) {
            throw new GarmentTypeNotExistsException();
        }

        $garmentEntity = $this->garmentRepository->insertGarment(
            $insertGarmentCommand->getName(),
            $garmentTypeEntity
        );

        $this->garmentRepository->persistAndFlush($garmentEntity);
    }
}
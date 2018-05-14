<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 10:06
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Garment\GarmentNameExists;

class InsertGarment
{
    private $garmentRepository;
    private $garmentTypeRepository;
    private $insertGarmentTransform;
    private $garmentNameExists;
    private $findGarmentTypeIfExists;

    /**
     * InsertGarment constructor.
     *
     * @param GarmentRepositoryInterface      $garmentRepository
     * @param GarmentTypeRepositoryInterface  $garmentTypeRepository
     * @param InsertGarmentTransformInterface $insertGarmentTransform
     * @param GarmentNameExists               $garmentNameExists
     * @param FindGarmentTypeIfExists         $findGarmentTypeIfExists
     */
    public function __construct(
        GarmentRepositoryInterface $garmentRepository,
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        InsertGarmentTransformInterface $insertGarmentTransform,
        GarmentNameExists $garmentNameExists,
        FindGarmentTypeIfExists $findGarmentTypeIfExists
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTransform = $insertGarmentTransform;
        $this->garmentNameExists = $garmentNameExists;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
    }

    /**
     * @param InsertGarmentCommand $insertGarmentCommand
     *
     * @return string
     */
    public function handle(InsertGarmentCommand $insertGarmentCommand)
    {
        $output = 'Garment insertado con exito';

        $name = $insertGarmentCommand->getName();
        $garmentTypeId = $insertGarmentCommand->getGarmentTypeId();

        try {
            $garmentTypeEntity = $this->findGarmentTypeIfExists->execute($garmentTypeId);
        } catch (GarmentTypeNotExistsException $gnex) {
            return $output = $gnex->getMessage();
        }

        try {
            $this->garmentNameExists->check($name);
        } catch (GarmentNameExistsException $gex) {
            return $output = $gex->getMessage();
        }

        $garmentEntity = $this->garmentRepository->insertGarment(
            $name,
            $garmentTypeEntity
        );

        $this->garmentRepository->persistAndFlush($garmentEntity);

        return $output;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 10:16
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Service\GarmentTypeNameExists;

class InsertGarmentType
{
    private $garmentTypeRepository;
    private $insertGarmentTypeTransform;
    private $garmentTypeNameExists;

    /**
     * InsertGarmentType constructor.
     *
     * @param GarmentTypeRepositoryInterface      $garmentTypeRepository
     * @param InsertGarmentTypeTransformInterface $insertGarmentTypeTransform
     * @param GarmentTypeNameExists               $garmentTypeNameExists
     */
    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        InsertGarmentTypeTransformInterface $insertGarmentTypeTransform,
        GarmentTypeNameExists $garmentTypeNameExists
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->insertGarmentTypeTransform = $insertGarmentTypeTransform;
        $this->garmentTypeNameExists = $garmentTypeNameExists;
    }

    /**
     * @param InsertGarmentTypeCommand $insertGarmentTypeCommand
     *
     * @return string
     * @throws UniqueConstraintViolationException
     */
    public function handle(InsertGarmentTypeCommand $insertGarmentTypeCommand): string
    {
        $output = 'GarmentType insertado con exito';
        $name = $insertGarmentTypeCommand->getName();

        try {
            $this->garmentTypeNameExists->check($name);
        } catch (GarmentTypeNameExistsException $gtex) {
            return $output = $gtex->getMessage();
        }

        $garmentTypeEntity = $this->garmentTypeRepository->insertGarmentType($name);


        $this->garmentTypeRepository->persistAndFlush($garmentTypeEntity);

        return $output;
    }
}

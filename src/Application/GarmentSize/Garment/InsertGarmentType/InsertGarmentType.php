<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 10:16
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\GarmentTypeNameExists;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;

class InsertGarmentType
{
    const OK = 'Tipo prenda insertado con exito';
    const CODE_OK = 200;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($this->garmentTypeNameExists);
    }

    /**
     * @param InsertGarmentTypeCommand $insertGarmentTypeCommand
     *
     * @return array
     */
    public function handle(InsertGarmentTypeCommand $insertGarmentTypeCommand): array
    {
        $output = ['data' => self::OK, 'code' => self::CODE_OK];

        $name = $insertGarmentTypeCommand->getName();

        $this->garmentTypeNameExists->check($name);

        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }

        $garmentTypeEntity = $this->garmentTypeRepository->insertGarmentType($name);

        $this->garmentTypeRepository->persistAndFlush($garmentTypeEntity);

        return $output;
    }
}

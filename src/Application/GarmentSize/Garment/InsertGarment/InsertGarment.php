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
use Symfony\Component\HttpFoundation\JsonResponse;

class InsertGarment
{
    const OK = 'Garment insertado con exito';
    const CODE_OK = 200;

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
     * @return array
     */
    public function handle(InsertGarmentCommand $insertGarmentCommand): array
    {
        $output = ['data' => self::OK, 'code' => self::CODE_OK];

        $name = $insertGarmentCommand->getName();
        $garmentTypeId = $insertGarmentCommand->getGarmentTypeId();

        try {
            $garmentTypeEntity = $this->findGarmentTypeIfExists->execute($garmentTypeId);
        } catch (GarmentTypeNotExistsException $gnex) {
            return [
                'data' => $gnex->getMessage(),
                'code' => $gnex->getCode()
            ];
        }

        try {
            $this->garmentNameExists->check($name);
        } catch (GarmentNameExistsException $gex) {
            return [
                'data' => $gex->getMessage(),
                'code' => $gex->getCode()
            ];
        }

        $garmentEntity = $this->garmentRepository->insertGarment(
            $name,
            $garmentTypeEntity
        );

        $this->garmentRepository->persistAndFlush($garmentEntity);

        return $output;
    }
}
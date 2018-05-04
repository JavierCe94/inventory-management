<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 14:38
 */

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\CheckIfSizeEntityExist;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;

class InsertNewSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExists;
    private $checkIfSizeEntityExist;
    private $insertNewSizeTransform;

    /**
     * InsertNewSize constructor.
     * @param SizeRepositoryInterface $sizeRepository
     * @param FindGarmentTypeIfExists $findGarmentTypeIfExists
     * @param InsertNewSizeTransformInterface $insertNewSizeTransform
     */
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExists,
        CheckIfSizeEntityExist $checkIfSizeEntityExist,
        InsertNewSizeTransformInterface $insertNewSizeTransform
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
        $this->insertNewSizeTransform = $insertNewSizeTransform;
        $this->checkIfSizeEntityExist = $checkIfSizeEntityExist;
    }

    /**
     * @param InsertNewSizeCommand $insertNewSizeCommand
     * @return array|\Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeAlreadyExist
     */
    public function handle(InsertNewSizeCommand $insertNewSizeCommand)
    {
        try {
            $garmentTypeEntity = $this->findGarmentTypeIfExists
                ->execute($insertNewSizeCommand->getGarmentTypeId());
        } catch (GarmentTypeNotExistsException $exception) {
            return [$exception->getMessage()];
        }

        $this->checkIfSizeEntityExist
            ->check($insertNewSizeCommand->getGarmentTypeId(), $insertNewSizeCommand->getSizeValue());

        $newSize  = $this->sizeRepository->addSize(
            $insertNewSizeCommand->getSizeValue(),
            $garmentTypeEntity
        );

        $this->sizeRepository->persistAndFlush($newSize);

        return $this->insertNewSizeTransform->transform([$newSize]);
    }
}

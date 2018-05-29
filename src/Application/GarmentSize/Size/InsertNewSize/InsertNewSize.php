<?php

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\CheckIfSizeEntityExist;

class InsertNewSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExists;
    private $checkIfSizeEntityExist;
    private $insertNewSizeTransform;
    
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
     * @return array
     * @throws GarmentTypeNotExistsException
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeAlreadyExist
     */
    public function handle(InsertNewSizeCommand $insertNewSizeCommand)
    {
        $garmentTypeEntity = $this->findGarmentTypeIfExists->execute(
            $insertNewSizeCommand->getGarmentTypeId()
        );
        $this->checkIfSizeEntityExist->check(
            $insertNewSizeCommand->getGarmentTypeId(),
            $insertNewSizeCommand->getSizeValue()
        );
        $newSize  = $this->sizeRepository->addSize(
            $insertNewSizeCommand->getSizeValue(),
            $garmentTypeEntity
        );
        $this->sizeRepository->persistAndFlush($newSize);

        return [
            'data' => $this->insertNewSizeTransform->transform([$newSize]),
            "code" => HttpResponses::OK
        ];
    }
}

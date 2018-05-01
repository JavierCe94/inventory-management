<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 14:38
 */

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;

class InsertNewSize
{
    private $sizeRepository;
    private $garmentTypeRespository;
    private $insertNewSizeTransform;
    private $sizeAlreadyExistException;

    /**
     * InsertNewSize constructor.
     * @param SizeRepositoryInterface $sizeRepository
     * @param GarmentTypeRepositoryInterface $garmentTypeRepository
     * @param InsertNewSizeTransformInterface $insertNewSizeTransform
     * @param $sizeAlreadyExistException
     */
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        InsertNewSizeTransformInterface $insertNewSizeTransform,
        $sizeAlreadyExistException
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->garmentTypeRespository = $garmentTypeRepository;
        $this->insertNewSizeTransform = $insertNewSizeTransform;
        $this->sizeAlreadyExistException = $sizeAlreadyExistException;
    }

    /**
     * @param InsertNewSizeCommand $insertNewSizeCommand
     * @return array|\Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size
     * @throws \Exception
     */
    public function handle(InsertNewSizeCommand $insertNewSizeCommand)
    {
        $garmentTypeEntity = $this->garmentTypeRespository
            ->findGarmentTypeById($insertNewSizeCommand->getGarmentTypeId());

        if (null === $garmentTypeEntity) {
            throw new \Exception();
        }


        $newSize  = $this->sizeRepository->addSize(
            $insertNewSizeCommand->getSizeValue(),
            $garmentTypeEntity
        );

        $this->sizeRepository->persistAndFlush($newSize);

        $newSize = $this->insertNewSizeTransform->transform([$newSize]);

        return $newSize;
    }


}

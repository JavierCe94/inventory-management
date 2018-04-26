<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 14:38
 */

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;

class InsertNewSize
{
    private $sizeRepository;
    private $garmentTypeRespository;
    private $insertNewSizeTransform;
    private $sizeAlreadyExistException;

    /**
     * InsertNewSize constructor.
     * @param $sizeRepository
     * @param $insertNewSizeTransform
     * @param $sizeAlreadyExistException
     */
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        InsertNewSizeTransformInterface $insertNewSizeTransform,
        $sizeAlreadyExistException
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->insertNewSizeTransform = $insertNewSizeTransform;
        $this->sizeAlreadyExistException = $sizeAlreadyExistException;
    }

    /**
     * @param InsertNewSizeCommand $insertNewSizeCommand
     * @return mixed
     */
    public function handle(InsertNewSizeCommand $insertNewSizeCommand)
    {
        $newSize = $this->sizeRepository->addSize(
            $insertNewSizeCommand->getSizeValue(),
            $insertNewSizeCommand->getGarmentType()
        );

        $newSize = $this->sizeRepository->persistAndFlush($newSize);

        $this->insertNewSizeTransform->transform($newSize);

        return $newSize;
    }


}

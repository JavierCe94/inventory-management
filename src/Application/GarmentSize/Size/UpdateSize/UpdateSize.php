<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 14:19
 */

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;

class UpdateSize
{
    private $sizeRepository;
    private $garmentTypeRepository;
    private $dataTransform;
    private $DoNotExistException;

    /**
     * UpdateSize constructor.
     * @param SizeRepositoryInterface $sizeRepository
     * @param GarmentTypeRepositoryInterface $garmentTypeRepository
     * @param UpdateSizeTransformInterface $dataTransform
     * @param $DoNotExistException
     */
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        UpdateSizeTransformInterface $dataTransform,
        $DoNotExistException
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->dataTransform = $dataTransform;
        $this->DoNotExistException = $DoNotExistException;
    }

    /**
     * @param UpdateSizeCommand $updateSizeCommand
     * @return array
     * @throws GarmentTypeDoNotExist
     * @throws SizeDoNotExist
     */
    public function handle(UpdateSizeCommand $updateSizeCommand)
    {
        $garmentTypeEntity = $this->garmentTypeRepository
            ->findGarmentTypeById($updateSizeCommand->getGarmentTypeId());

        if (null === $garmentTypeEntity) {
            throw new GarmentTypeDoNotExist('el tipo de prenda no existe');
        }
        $size = $this->sizeRepository->findSizeBySizeValueAndGarmentType(
            $updateSizeCommand->getSizeValue(),
            $updateSizeCommand->getGarmentTypeId()
        );
        if (0 === count($size)) {
            throw new SizeDoNotExist('La talla no se encuentra');
        }

        $sizeUpdated  = $this->sizeRepository->updateSize(
            $updateSizeCommand->getNewSizeValue(),
            $size[0]
        );

        $this->sizeRepository->persistAndFlush($sizeUpdated);
        return $this->dataTransform->transform($sizeUpdated);
    }

}

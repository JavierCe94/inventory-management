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
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;

class UpdateSize
{
    private $sizeRepository;
    private $findGarmentTypeIfExist;
    private $dataTransform;
    private $findSizeEntityIfExist;

    /**
     * UpdateSize constructor.
     * @param SizeRepositoryInterface $sizeRepository
     * @param FindGarmentTypeIfExists $findGarmentTypeIfExist
     * @param UpdateSizeTransformInterface $dataTransform
     * @param FindSizeEntityIfExists $findSizeEntityIfExist
     */
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExist,
        UpdateSizeTransformInterface $dataTransform,
        FindSizeEntityIfExists $findSizeEntityIfExist
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExist = $findGarmentTypeIfExist;
        $this->dataTransform = $dataTransform;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
    }

    /**
     * @param UpdateSizeCommand $updateSizeCommand
     * @return array
     * @throws SizeDoNotExist
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException
     */
    public function handle(UpdateSizeCommand $updateSizeCommand)
    {
        $onlyElementInArray = 0;
        $this->findGarmentTypeIfExist->execute($updateSizeCommand->getGarmentTypeId());

        $size = $this->findSizeEntityIfExist
            ->execute(
                $updateSizeCommand->getGarmentTypeId(),
                $updateSizeCommand->getSizeValue()
            );

        $sizeUpdated  = $this->sizeRepository->updateSize(
            $updateSizeCommand->getNewSizeValue(),
            $size[$onlyElementInArray]
        );

        $this->sizeRepository->persistAndFlush($sizeUpdated);
        return $this->dataTransform->transform($sizeUpdated);
    }

}

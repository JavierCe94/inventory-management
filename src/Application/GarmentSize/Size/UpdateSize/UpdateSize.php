<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 14:19
 */

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($findGarmentTypeIfExist);
        ListExceptions::instance()->attach($findSizeEntityIfExist);
    }

    /**
     * @param UpdateSizeCommand $updateSizeCommand
     * @return array|mixed
     * @throws SizeDoNotExist
     */
    public function handle(UpdateSizeCommand $updateSizeCommand)
    {
        $this->findGarmentTypeIfExist->execute($updateSizeCommand->getGarmentTypeId());

        $size = $this->findSizeEntityIfExist
            ->execute(
                $updateSizeCommand->getGarmentTypeId(),
                $updateSizeCommand->getSizeValue()
            );

        if (ListExceptions::instance()->checkForException()) {
            return ListExceptions::instance()->firstException();
        }

        $sizeUpdated  = $this->sizeRepository->updateSize(
            $updateSizeCommand->getNewSizeValue(),
            $size
        );


        $this->sizeRepository->persistAndFlush($sizeUpdated);

        return [
            "data" => $this->dataTransform->transform($sizeUpdated),
            "code" => HttpResponses::OK
            ];
    }

}

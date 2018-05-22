<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 22/05/18
 * Time: 14:57
 */

namespace Inventory\Management\Application\GarmentSize\UpdateGarmentSize;


use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTableTransformInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\FindGarmentSizeIfExist;
use Inventory\Management\Domain\Service\GarmentSize\Garment\CheckGarmentTypeAreEquals;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;

class UpdateGarmentSize
{

    private $garmentSizeRepository;
    private $findGarmentIfExist;
    private $findSizeEntityIfExist;
    private $findGarmentSizeIfExist;
    private $checkGarmentTypeAreEquals;
    private $dataTransform;

    /**
     * CreateGarmentSizeTable constructor.
     * @param $garmentTypeRepository
     * @param $findAllGarmentSize
     * @param $findGarmentTypeIfExist
     * @param $findSizeEntityIfExist
     * @param $checkGarmentSizeExist
     */
    public function __construct(
        GarmentSizeRepositoryInterface $garmentSizeRepository,
        FindGarmentIfExists $findGarmentIfExist,
        FindSizeEntityIfExists $findSizeEntityIfExist,
        FindGarmentSizeIfExist $findGarmentSizeIfExist,
        CheckGarmentTypeAreEquals $checkGarmentTypeAreEquals,
        CreateGarmentSizeTableTransformInterface $dataTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->findGarmentIfExist = $findGarmentIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->findGarmentSizeIfExist = $findGarmentSizeIfExist;
        $this->checkGarmentTypeAreEquals = $checkGarmentTypeAreEquals;
        $this->dataTransform = $dataTransform;
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($findSizeEntityIfExist);
        ListExceptions::instance()->attach($findGarmentIfExist);
        ListExceptions::instance()->attach($findGarmentSizeIfExist);
        ListExceptions::instance()->attach($checkGarmentTypeAreEquals);
    }

    /**
     * @param UpdateGarmentSizeCommand $updateGarmentSizeCommand
     * @return array|mixed
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist
     */
    public function handle(UpdateGarmentSizeCommand $updateGarmentSizeCommand)
    {
        $size = $this->findSizeEntityIfExist
            ->execute($updateGarmentSizeCommand->getIdSize(), $updateGarmentSizeCommand->getSizeValue());

        $garment = $this->findGarmentIfExist->execute($updateGarmentSizeCommand->getIdGarment());

        if (ListExceptions::instance()->checkForException()) {
            return ListExceptions::instance()->firstException();
        };

        $this->checkGarmentTypeAreEquals->execute($size->getGarmentType(), $garment->getGarmentType());

        $garmenSize = $this->findGarmentSizeIfExist->__invoke($size, $garment);

        if (ListExceptions::instance()->checkForException()) {
            return ListExceptions::instance()->firstException();
        };

        $garmenSize->setStock($updateGarmentSizeCommand->getStock());

        $this->garmentSizeRepository->persistAndFlush($garmenSize);

        return [
            "data" => "updated",
            "code" => HttpResponses::OK
        ];
    }

}
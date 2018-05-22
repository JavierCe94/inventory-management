<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 9:41
 */

namespace Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable;


use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\CheckGarmentSizeExist;
use Inventory\Management\Domain\Service\GarmentSize\Garment\CheckGarmentTypeAreEquals;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;

class CreateGarmentSizeTable
{
    private $garmentSizeRepository;
    private $findGarmentIfExist;
    private $findSizeEntityIfExist;
    private $checkGarmentSizeExist;
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
        CheckGarmentSizeExist $checkGarmentSizeExist,
        CheckGarmentTypeAreEquals $checkGarmentTypeAreEquals,
        CreateGarmentSizeTableTransformInterface $dataTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->findGarmentIfExist = $findGarmentIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->checkGarmentSizeExist = $checkGarmentSizeExist;
        $this->checkGarmentTypeAreEquals = $checkGarmentTypeAreEquals;
        $this->dataTransform = $dataTransform;
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($findSizeEntityIfExist);
        ListExceptions::instance()->attach($findGarmentIfExist);
        ListExceptions::instance()->attach($checkGarmentSizeExist);
        ListExceptions::instance()->attach($checkGarmentTypeAreEquals);
    }

    /**
     * @param CreateGarmentSizeTableCommand $createGarmentSizeTableCommand
     * @return array|mixed
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist
     */
    public function handle(CreateGarmentSizeTableCommand $createGarmentSizeTableCommand)
    {
        $size = $this->findSizeEntityIfExist
            ->execute($createGarmentSizeTableCommand->getIdSize(), $createGarmentSizeTableCommand->getSizeValue());

        $garment = $this->findGarmentIfExist->execute($createGarmentSizeTableCommand->getIdGarment());

        if (ListExceptions::instance()->checkForException()) {
            return ListExceptions::instance()->firstException();
        };

        $this->checkGarmentTypeAreEquals->execute($size->getGarmentType(), $garment->getGarmentType());

        $this->checkGarmentSizeExist->__invoke($size, $garment);

        if (ListExceptions::instance()->checkForException()) {
            return ListExceptions::instance()->firstException();
        };

        $newGarmentSize = GarmentSize::createFromApi($size, $garment);

        $this->garmentSizeRepository->persistAndFlush($newGarmentSize);

        return [
            "data" => "created",
            "code" => HttpResponses::OK
            ];
    }

}
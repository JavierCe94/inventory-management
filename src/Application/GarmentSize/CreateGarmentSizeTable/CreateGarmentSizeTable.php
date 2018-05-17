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
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;

class CreateGarmentSizeTable
{
    private $garmentTypeRepository;
    private $garmentSizeRepository;
    private $findGarmentIfExist;
    private $findSizeEntityIfExist;
    private $checkGarmentSizeExist;
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
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        GarmentSizeRepositoryInterface $garmentSizeRepository,
        FindGarmentIfExists $findGarmentIfExist,
        FindSizeEntityIfExists $findSizeEntityIfExist,
        CheckGarmentSizeExist $checkGarmentSizeExist,
        CreateGarmentSizeTableTransformInterface $dataTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->findGarmentIfExist = $findGarmentIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->checkGarmentSizeExist = $checkGarmentSizeExist;
        $this->dataTransform = $dataTransform;
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($findSizeEntityIfExist);
        ListExceptions::instance()->attach($findGarmentIfExist);
        ListExceptions::instance()->attach($checkGarmentSizeExist);
    }

    /**
     * @param CreateGarmentSizeTableCommand $createGarmentSizeTableCommand
     * @return array|mixed
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist
     */
    public function handle(CreateGarmentSizeTableCommand $createGarmentSizeTableCommand)
    {
        $searchFiltered = $this->getArrayWithDifferentFromTable();

        $this->createEntitysInDataBase($searchFiltered);

        if (ListExceptions::instance()->checkForException()) {
            return ListExceptions::instance()->firstException();
        };

        return [
            "data" => "created",
            "code" => HttpResponses::OK
            ];
    }

    private function getArrayWithDifferentFromTable(): array
    {
        $fromRepository = $this->garmentTypeRepository->listGarmentTypes();
        $searchFiltered = [];
        foreach ($fromRepository as $item) {
            if( $this->checkGarmentSizeExist ) {
                $searchFiltered [] = [
                    "sizeId" => $item["sizeId"],
                    "sizeValue" => $item["sizeValue"],
                    "garmentId" => $item["garmentId"]
                ];
            }
        }
        return $searchFiltered;
    }

    /**
     * @param array $searchFiletered
     * @throws \Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist
     */
    private function createEntitysInDataBase(array $searchFiletered): void
    {
        foreach ($searchFiletered as $item) {
            $garment = $this->findGarmentIfExist->execute($item["garmentId"]);

            $size = $this->findSizeEntityIfExist->execute($item["sizeId"], $item["sizeValue"]);

            $this->garmentSizeRepository
                ->persistAndFlush(GarmentSize::createFromAutoTable($size, $garment));
        }
    }
}
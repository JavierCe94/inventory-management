<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 13:04
 */

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;

class ListSizeByGarmentType
{
    private $dataTransform;
    private $sizeRepository;
    private $findGarmentTypeIfExists;


    /**
     * ListSizeByGarmentType constructor.
     * @param SizeRepositoryInterface $sizeRepository
     * @param FindGarmentTypeIfExists $findGarmentTypeIfExists
     * @param ListSizeByGarmentTypeTransformInterface $dataTransform
     */
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        FindGarmentTypeIfExists $findGarmentTypeIfExists,
        ListSizeByGarmentTypeTransformInterface $dataTransform
    ) {
        $this->dataTransform = $dataTransform;
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($findGarmentTypeIfExists);
    }

    /**
     * @param ListSizeByGarmentTypeCommand $listSizeByGarmentTypeCommand
     * @return array|mixed
     * @throws GarmentTypeNotExistsException
     */
    public function handle(ListSizeByGarmentTypeCommand $listSizeByGarmentTypeCommand)
    {
        $this->findGarmentTypeIfExists
            ->execute($listSizeByGarmentTypeCommand->getGarmentTypeId());

        if (ListExceptions::instance()->checkForException()) {
            return ListExceptions::instance()->firstException();
        }

        $garmentTypeList = $this->sizeRepository
            ->findByGarmentType($listSizeByGarmentTypeCommand->getGarmentTypeId());

        return [
            "data" => $this->dataTransform->transform($garmentTypeList),
            "code" => HttpResponses::OK
            ];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 13:04
 */

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

use Inventory\Management\Application\GarmentSize\Size\ListAllSize\ListAllSizeTransformInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;

class ListSizeByGarmentType
{
    private $dataTransform;
    private $sizeRepository;
    private $emptySizesException;

    /**
     * ListSizeByGarmentType constructor.
     * @param $dataTransform
     * @param $sizeRepository
     * @param $emptySizesException
     */
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        ListAllSizeTransformInterface $dataTransform,
        $emptySizesException
    ) {
        $this->dataTransform = $dataTransform;
        $this->sizeRepository = $sizeRepository;
        $this->emptySizesException = $emptySizesException;
    }

    public function handle(ListSizeByGarmentTypeCommand $listSizeByGarmentTypeCommand)
    {
        $garmentTypeList = $this->sizeRepository
            ->findByGarmentType($listSizeByGarmentTypeCommand->getGarmentTypeId());

        if (0 === count($garmentTypeList)) {
            throw new \Exception();
        }

        $garmentTypeList = $this->dataTransform->transform($garmentTypeList);

        return $garmentTypeList;
    }
}

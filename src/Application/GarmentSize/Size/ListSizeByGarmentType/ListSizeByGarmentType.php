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
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;

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
    }

    /**
     * @param ListSizeByGarmentTypeCommand $listSizeByGarmentTypeCommand
     * @return array
     */
    public function handle(ListSizeByGarmentTypeCommand $listSizeByGarmentTypeCommand)
    {
        try {
            $this->findGarmentTypeIfExists
            ->execute($listSizeByGarmentTypeCommand->getGarmentTypeId());
        } catch (GarmentTypeNotExistsException $exception) {
             return [$exception->getMessage()];
        }

        $garmentTypeList = $this->sizeRepository
            ->findByGarmentType($listSizeByGarmentTypeCommand->getGarmentTypeId());

        return $this->dataTransform->transform($garmentTypeList);
    }
}

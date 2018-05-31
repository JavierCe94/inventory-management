<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryI;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExistsI;

class ListSizeByGarmentType
{
    private $dataTransform;
    private $sizeRepository;
    private $findGarmentTypeIfExists;
    
    public function __construct(
        SizeRepositoryI $sizeRepository,
        FindGarmentTypeIfExistsI $findGarmentTypeIfExists,
        ListSizeByGarmentTypeTransformI $dataTransform
    ) {
        $this->dataTransform = $dataTransform;
        $this->sizeRepository = $sizeRepository;
        $this->findGarmentTypeIfExists = $findGarmentTypeIfExists;
    }

    /**
     * @throws GarmentTypeNotExistsException
     */
    public function handle(ListSizeByGarmentTypeCommand $listSizeByGarmentTypeCommand)
    {
        $this->findGarmentTypeIfExists->execute(
            $listSizeByGarmentTypeCommand->getGarmentTypeId()
        );
        $garmentTypeList = $this->sizeRepository->findByGarmentType(
            $listSizeByGarmentTypeCommand->getGarmentTypeId()
        );

        return $this->dataTransform->transform($garmentTypeList);
    }
}

<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;

class ListSizeByGarmentType
{
    private $dataTransform;
    private $sizeRepository;
    private $findGarmentTypeIfExists;
    
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
     * @return array|mixed
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

        return [
            "data" => $this->dataTransform->transform($garmentTypeList),
            "code" => HttpResponses::OK
        ];
    }
}

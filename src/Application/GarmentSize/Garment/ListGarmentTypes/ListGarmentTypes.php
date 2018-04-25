<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 13:13
 */

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class ListGarmentTypes
{
    private $garmentTypeRepository;
    private $listGarmentTypesTransform;

    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        ListGarmentTypesTransformInterface $listGarmentTypesTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->listGarmentTypesTransform = $listGarmentTypesTransform;
    }

    public function handle(ListGarmentTypesCommand $listGarmentTypesCommand): array
    {
        $queryOutput = $this->garmentTypeRepository->listGarmentTypes();
        return $this->listGarmentTypesTransform->transform($queryOutput);
    }
}
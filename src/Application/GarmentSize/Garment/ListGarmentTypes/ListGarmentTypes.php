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

    /**
     * ListGarmentTypes constructor.
     *
     * @param GarmentTypeRepositoryInterface     $garmentTypeRepository
     * @param ListGarmentTypesTransformInterface $listGarmentTypesTransform
     */
    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        ListGarmentTypesTransformInterface $listGarmentTypesTransform
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->listGarmentTypesTransform = $listGarmentTypesTransform;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        $queryOutput = $this->garmentTypeRepository->listGarmentTypes();
        return $this->listGarmentTypesTransform->transform($queryOutput);
    }
}
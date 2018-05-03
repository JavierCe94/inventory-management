<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 11:49
 */

namespace Inventory\Management\Domain\Model\Service;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;

class FindGarmentTypeIfExists
{
    private $garmentTypeRepository;
    public function __construct(GarmentTypeRepository $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
    }

    /**
     * @param int $id
     *
     * @return GarmentType|null
     * @throws GarmentTypeNotExistsException
     */
    public function execute(int $id): ?GarmentType
    {
        $output = $this->garmentTypeRepository->findGarmentTypeById($id);
        if (is_null($output)) {
            throw new GarmentTypeNotExistsException();
        }
        return $output;
    }
}

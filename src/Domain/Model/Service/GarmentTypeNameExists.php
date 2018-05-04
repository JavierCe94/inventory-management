<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 10:04
 */

namespace Inventory\Management\Domain\Model\Service;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class GarmentTypeNameExists
{
    private $garmentTypeRepository;
    public function __construct(GarmentTypeRepositoryInterface $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
    }

    public function check(string $name)
    {
        $output = $this->garmentTypeRepository->findGarmentTypeByName($name);
        if (null !== $output) {
            throw new GarmentTypeNameExistsException();
        }
    }
}
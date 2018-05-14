<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 03/05/2018
 * Time: 13:00
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;

class GarmentTypeNameExists
{
    private $garmentTypeRepository;

    public function __construct(GarmentTypeRepositoryInterface $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
    }

    /**
     * @param string $name
     * @throws GarmentTypeNameExistsException
     */
    public function check(string $name)
    {
        $output = $this->garmentTypeRepository->findGarmentTypeByName($name);
        if (null !== $output) {
            throw new GarmentTypeNameExistsException();
        }
    }
}

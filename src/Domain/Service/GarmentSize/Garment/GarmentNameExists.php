<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 11:18
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;

class GarmentNameExists
{
    private $garmentRepository;
    public function __construct(GarmentRepositoryInterface $garmentRepository)
    {
        $this->garmentRepository = $garmentRepository;
    }

    public function check(string $name)
    {
        $output = $this->garmentRepository->findGarmentByName($name);
        if (null !== $output) {
            throw new GarmentNameExistsException();
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 12:39
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;

class FindGarmentIfExists
{
    private $garmentRepository;

    public function __construct(GarmentRepositoryInterface $garmentRepository)
    {
        $this->garmentRepository = $garmentRepository;
    }

    /**
     * @param int $id
     *
     * @return Garment|null
     * @throws GarmentNotExistsException
     */
    public function execute(int $id): ?Garment
    {
        $output = $this->garmentRepository->findGarmentById($id);
        if (null === $output) {
            throw new GarmentNotExistsException();
        }
        return $output;
    }
}